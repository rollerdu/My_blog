<?php
namespace Admin\Controller;
use Admin\Controller;
/**
 * 转盘抽奖管理
 */
class AwardController extends BaseController {

    public function setting()
    {
        $model = M("award");
        $count  = $model->count();//
        $Page = new \Extend\Page($count,20);//
        $show = $Page->show();// 分页显示输出
        $data = $model->limit($Page->firstRow.','.$Page->listRows)->order('id DESC')->select();
        $this->assign('data', $data);
        $this->assign('page',$show);
        $this->assign('count',$count);
        $this->display();
    }
    public function add(){
        if(IS_POST){
            $model = M("award");
            $model->title = trim(I("param.title"));
            $model->intro = trim(I('param.intro'));
            $model->status = I("param.status") ? 1 : 0;
            $model->odds = intval(I("param.odds"));
            $model->ctime = date('Y-m-d H:i:s');
            $ret = $model->add();
            if($ret){
                $this->success("添加成功！");
            }else{
                $this->error('添加失败！');
            }
        }
        $this->display();

    }
    public function edit(){
        $id = intval(I("param.id"));
        if(!$id)$this->error('数据有误，请刷新重试！');
        $model = M("award");
        $award = $model->where(array('id'=>$id))->find();
        if(IS_POST){
            $data['title'] = trim(I("param.title"));
            $data['intro'] = trim(I('param.intro'));
            $data['odds'] = intval(I("param.odds"));
            $data = array_filter($data);
            $data['status'] = intval(I("param.status")) ? 1 : 0;
            $ret = $model->where(array('id'=>$id))->save($data);
            if($ret >= 0 ){
                $this->success("编辑成功！");
            }else{
                $this->error('编辑失败！');
            }
        }
        $this->assign('award',$award);
        $this->display();
    }
    public function delete() {
        $id = intval(I("get.id"));
        if(!$id) $this->error("操作有误！");
        $model = M("award");
        $status = $model->delete($id);
        if ($status!==false) {
            $this->success("操作成功！", U('award/setting'));
        } else {
            $this->error("操作失败！");
        }

    }
    public function index(){
        $model = M("winners");
        $mobile = I("param.mobile");
        if($mobile){
            $where['mobile'] = array('like',"%$mobile%");
        }
        $count  = $model->where($where)->count();//
        $Page = new \Extend\Page($count,20);//
        $show = $Page->show();// 分页显示输出
        $data = $model->where($where)->limit($Page->firstRow.','.$Page->listRows)->order('id DESC')->select();
        $this->assign('data', $data);
        $this->assign('page',$show);
        $this->assign('count',$count);
        $this->assign('mobile',$mobile);
        $this->display();
    }
    public function winners_status(){
        $model = M("winners");
        $id = intval(I('param.id'));
        if(!$id) $this->error('信息有误，请刷新重试！');
        $data = $model->where(array('id'=>$id))->find();
        if($data['status'] == 1){
            $this->success('该奖品已领取');
        }
        $ret = $model->where(array('id'=>$id))->save(array('status'=>1));
        if($ret){
            $this->success('领取成功！');
        }else{
            $this->error('领取失败！');
        }
    }
    public function winner_delete() {
        $id = intval(I("get.id"));
        if(!$id) $this->error("操作有误！");
        $model = M("winners");
        $status = $model->delete($id);
        if ($status!==false) {
            $this->success("操作成功！", U('award/index'));
        } else {
            $this->error("操作失败！");
        }

    }

}
