<?php
/**
 * Created by PhpStorm.
 * User: duyang
 * Date: 2016/11/30
 * Time: 10:23
 */

namespace Home\Controller;
use Home\Controller;

class IndexController extends BaseLoginController{


    public function __construct()
    {
        parent::__construct();
        $model = M("category");
        $cate = $model->where(array('status'=>1,'pid'=>0))->field("id,pid,name,icon")->select();
        foreach($cate as $k=>$v){
            $cate[$k]['child'] = $model->where(array('status'=>1,'pid'=>$v['id']))->select();
        }
        $this->assign('cate',$cate);
    }

    public function index(){

        $this->assign('action',__FUNCTION__);
        $this->display();
    }
    public function about(){
        $this->assign('action',__FUNCTION__);
        $this->display();
    }
    public function review(){
        $cate_id = intval(I("param.cateid"));
        $cate_arr = M('category')->where("pid=$cate_id")->getField("id",true);
        $cate_ids = $cate_arr ? (implode(',',$cate_arr).','.$cate_id) : "$cate_id";
        $model = M("article");
        $page = intval(I("param.page")) > 0 ? intval(I('param.page')) : 1;
        $key = I("param.key") ? trim(I("param.key")) : null;
        $where['a.status'] = 1;
        $where['a.cate_id'] = array('in',$cate_ids);
        if($key){
            $where['a.title'] = array('like',"%$key%");
        }
        $data = $model->alias('a')->where($where)->join(C("DB_PREFIX")."tags  t on FIND_IN_SET(t.id,a.tag_id)","LEFT")
            ->limit(($page-1)*20,20)
            ->field("a.*,t.tvalue")->select();
        if($page > 1){
            $this->ajaxReturn(array('status'=>1,'data'=>$data));
        }else{
            $this->assign('data',$data);
            $this->assign('action',__FUNCTION__);
            $this->display();
        }
    }
    public function single(){
        $id = intval(I("param.id"));
        if(!$id) $this->error('数据有误！');
        $data = M("article")->alias('a')
            ->where(array('a.status'=>1,'a.id'=>$id))
            ->join(C('DB_PREFIX')."member m on m.id=a.member_id",'LEFT')
            ->field('a.*,m.username')
            ->find();
        $data['content'] = html_entity_decode(htmlspecialchars_decode($data['content']));
        M("article")->where(array('id'=>$id))->setField('view_num',$data['view_num']+1);
        $data['view_num'] ++;
        $this->assign('data',$data);
        $this->assign('action',__FUNCTION__);
        $this->display();
    }

    public function message(){
        if(cookie('message') >10) $this->error('今天留言机会已用光，请明天再来哦！');
        $data['artid'] = intval(I("param.art_id"));
        $data['title'] = trim(I("param.title"));
        $data['email'] = trim(I("param.email"));
        $data['name'] = trim(I("param.name"));
        $data['content'] = trim(I("param.content"));
        if(!$data['title']) $this->error('请填写标题');
        if(!$data['email']) $this->error('请填写邮箱');
        if(!$data['content']) $this->error('请填写内容');
        $ret = M("message")->add($data);
        if($ret){
            cookie('message',cookie('message')+1);
            $this->success('留言成功，等待管理员给您回复哦！');
        }else{
            $this->error('留言失败了，请刷新重试！');
        }
    }
    public function contact(){
        $this->assign('action',__FUNCTION__);
        $this->display();
    }
    public function gallery(){
        $this->assign('action',__FUNCTION__);
        $this->display();
    }

    public function shortcodes(){
        $this->assign('action',__FUNCTION__);
        $this->display();
    }
    public function lottery(){
        $award_model = M("award");
        if($_SESSION['mobile']) $this->assign('mobile',$_SESSION['mobile']);
        if(IS_POST){
            $mobile = I("post.mobile");
            if(!$mobile) $this->error('请输入手机号');
            session('mobile',$mobile);
            $data = M("winners")->where(array('mobile'=>$mobile))->find();
            if($data && is_array($data)){
                $this->error("您已中得：<br>".$data['award']);
            }
            $odds = $award_model->where(array('status'=>1))->select();
            foreach($odds as $key => $val){
                $proArr[$val['id']] = $val['odds'];
                $award_arr[$val['id']]['title'] = $val['title'];
                $award_arr[$val['id']]['intro'] = $val['intro'];

            }
            $ret = $this->get_rand($proArr);
            M("winners")->add(array('mobile'=>$mobile,'awid'=>$ret,'award'=>$award_arr[$ret]['title'],'intro'=>$award_arr[$ret]['intro']));
            $this->success("恭喜您中得：<br>".$award_arr[$ret]['title'],$ret);
        }
        $award = $award_model->where(array('status'=>1))->order('id')->getField('title',true);
        $this->assign('award',json_encode($award));
        $this->display();
    }
    public function lottery_intro(){
        $this->display();
    }

    private function get_rand($proArr) {
        $result = '';

        //概率数组的总概率精度
        $proSum = array_sum($proArr);

        //概率数组循环
        foreach ($proArr as $key => $proCur) {
            $randNum = mt_rand(1, $proSum);
            if ($randNum <= $proCur) {
                $result = $key;
                break;
            } else {
                $proSum -= $proCur;
            }
        }
        unset ($proArr);
        return $result;
    }

//    public function get_token(){
//        $options = array(
//            'token'=>C('WXTOKEN'), //填写你设定的key
//            'encodingaeskey'=>C('ENCODINGAESKEY'), //填写加密用的EncodingAESKey，如接口为明文模式可忽略
//            'appid'=>C('APPID'), //填写高级调用功能的app id
//            'appsecret'=>C('APPSECRET') //填写高级调用功能的密钥
//        );
//        vendor("wechat.wechat#class");
//        $weObj = new \wechat($options);
//        $weObj->valid();//明文或兼容模式可以在接口验证通过后注释此句，但加密模式一定不能注释，否则会验证失败
//        $type = $weObj->getRev()->getRevType();
//        switch($type) {
//            case \Wechat::MSGTYPE_TEXT:
//                $weObj->transfer_customer_service()->reply();
//                exit;
//                break;
//            case \Wechat::MSGTYPE_EVENT:
//                $event = $weObj->getRev()->getRevEvent()['event'];
//                if($event == 'subscribe'){
//                    $weObj->text("华艺跨年盛典报名大惠三天")->reply();
//
//                }elseif($event == 'LOCATION')
//                    $lat = $weObj->getRev()->getRevEventGeo()['x'];
//                $lng = $weObj->getRev()->getRevEventGeo()['y'];
//                $openid = $weObj->getRev()->getRevFrom();
//                break;
//            case \Wechat::MSGTYPE_IMAGE:
//                break;
//            default:
//                $weObj->text("亲，我们的工程师正在努力开发哦，稍等。。。")->reply();
////                $weObj->text("help info")->reply();
//        }
//    }

}