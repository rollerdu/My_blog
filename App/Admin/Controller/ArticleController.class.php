<?php
/**
 * Created by PhpStorm.
 * User: 1
 * Date: 2016/11/17
 * Time: 17:07
 * 系统基本设置
 */

namespace Admin\Controller;
use Think\Controller;
class ArticleController extends BaseController
{
    public $listRows = 20;

    public function index(){
        $user_id = $this->user['id'];
        if($user_id == 1){
            $where = "";
        }else{
            $where['member_id'] = $user_id;
        }
        $cate_id = intval(I('get.cate_id'));
        $start_time = I('get.start_time');
        $end_time = I('get.end_time');
        $title = I('get.title');
        if($cate_id){
            $cateids = implode(',',M("Category")->where(array('pid'=>$cate_id))->getField('id',true)).','.$cate_id;
            $where['a.cate_id'] = array('in',$cateids);
        }
        if($start_time && $end_time){
            $where['a.time'] = array('BETWEEN',array($start_time,$end_time));
        }elseif($start_time){
            $where['a.time'] = array('GT',$start_time);
        }elseif($end_time){
            $where['a.time'] = array('LT',$end_time);
        }
        if($title){
            $where['a.title'] = array('like','%'.$title.'%');
        }
        $model = M("Article");
        $count = $model->alias('a')->where($where)->count();
//        var_dump($model->getLastSql());exit;
        $Page = new \Extend\Page($count,$this->listRows);
        $data = $model->where($where)->limit($Page->firstRow.','.$Page->listRows)->alias('a')
            ->join(C('DB_PREFIX').'category c on a.cate_id=c.id','left')
            ->join(C('DB_PREFIX').'member m on m.id=a.member_id','left')
            ->field('a.*,c.name cateName,m.username')
            ->order('a.time desc')
            ->select();
        $this->assign('cate',getSortedCategory(M('category')->select()));
        $this->assign('page',$Page->show());
        $this->assign('data',$data);
        $this->assign('cate_id',$cate_id);
        $this->assign('start_time',$start_time);
        $this->assign('end_time',$end_time);
        $this->assign('title',$title);
        $this->assign('count',$count);
        $this->display();
    }
    public function add(){
        if(IS_POST){
            $data['member_id'] = $this->user['id'];
            $data['title'] = I("post.title");
            $data['cate_id'] = intval(I('post.cate_id'));
            $data['sort'] = intval(I("post.sort"));
            $data['tag_id'] = implode(',',I('post.tags'));
            $data['status'] = intval(I('post.status')) ? 1 : 0;
            $data['intro'] = I('post.intro');
            $data['source'] = I('post.source');
            $data['content'] = htmlspecialchars(I('post.editorValue'));
            if(!$data['title'] || !$data['intro'] || !$data['content']) $this->error('文章标题、简介、内容缺一不了！');
            if(!$data['cate_id']) $this->error('请选择文章栏目！');
            $ins = M("Article")->add($data);
            if($ins){
                $this->success('添加成功！');
            }else{
                $this->error('添加失败！');
            }
            exit;
        }
        $tags = M("tags")->select();
        $this->assign('tags',$tags);
        $this->assign('cate',getSortedCategory(M('category')->select()));
        $this->display();
    }
    public function edit(){
        $user_id = $this->user['id'];
        $id = intval(I('param.id'));
        $model = M('Article');
        if($user_id == '1'){
            $where = "";
        }else{
            $where['member_id'] = $user_id;
        }
        $where['id'] = $id;
        $ret = $model->where($where)->find();
        if(!$ret) $this->error('您没有权限编辑该文章！');
        $ret['content'] = html_entity_decode(htmlspecialchars_decode($ret['content']));
        if(IS_POST){
            $data['title'] = I("post.title");
            $data['cate_id'] = intval(I('post.cate_id'));
            $data['sort'] = intval(I("post.sort"));
            $data['tag_id'] = implode(',',I('post.tags'));
            $data['status'] = intval(I('post.status')) ? 1 : 0;
            $data['intro'] = I('post.intro');
            $data['source'] = I('post.source');
            $data['content'] = htmlspecialchars(I('post.editorValue'));
            $data = array_filter($data);
            $re = $model->where($where)->save($data);
            if($re || $re == 0){
                $this->success('更新成功！');
            }else{
                $this->error('更新失败！');
            }
        }

        $tags = M("tags")->select();
        $this->assign('art',$ret);
        $this->assign('tags',$tags);
        $this->assign('cate',getSortedCategory(M('category')->select()));
        $this->display();
    }
    public function inline(){
        $id = intval(I('get.id'));
        if(!$id) $this->error('数据有误，请刷新重试！');
        $user_id = $this->user['id'];
        $model = M('Article');
        if($user_id == 1){
            $where = "";
        }else{
            $where['member_id'] = $user_id;
        }
        $where['id'] = $id;
        $ret = $model->where($where)->find();
        if(!$ret) $this->error('您没有权限编辑该文章！');
        $to = $ret['status'] ? 0 : 1;
        $message = $ret['status'] ? '已下架！' : '已发布！';
        $model->where(array('id'=>$id))->setField(array('status'=>$to));
        $this->success($message);
    }
    public function delete(){
        $id = intval(I('get.id'));
        if(!$id) $this->error('数据有误，请刷新重试！');
        $user_id = $this->user['id'];
        $model = M('Article');
        if($user_id == 1){
            $where = "";
        }else{
            $where['member_id'] = $user_id;
        }
        $where['id'] = $id;
        $ret = $model->where($where)->find();
        if(!$ret) $this->error('您没有权限删除该文章！');
        $model->where($where)->delete();
        $this->success('删除成功！');
    }

}