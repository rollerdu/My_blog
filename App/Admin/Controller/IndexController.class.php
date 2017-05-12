<?php
namespace Admin\Controller;
use Admin\Controller;

class IndexController extends BaseController{
    

    public function index(){

        $this->display();
    }


    public function welcome(){
        $loginInfo = M("member_login")->where(array('member_id'=>$this->user['id']))->order('id desc')->find();
        $this->assign('loginInfo',$loginInfo);
        $this->display();
    }
    public function info(){
        $info_arr = json_decode($_SESSION['adminManage'],true);
        var_dump($info_arr);
    }
}
