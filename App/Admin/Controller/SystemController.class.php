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
class SystemController extends BaseController
{
    public $listRows = 20;
    public function index(){

    }
    public function  log_index(){
        $model = M("member_login");
        $count = $model->count();
        $Page = new \Extend\Page($count,$this->listRows);
        $data = $model->limit($Page->firstRow.','.$Page->listRows)->alias('a')
            ->join(C('DB_PREFIX').'member m on a.member_id=m.id','left')
            ->field('a.*,m.username')
            ->order('a.id desc')
            ->select();
        $this->assign('page',$Page->show());
        $this->assign('data',$data);
        $this->assign('count',$count);
        $this->display();
    }

}