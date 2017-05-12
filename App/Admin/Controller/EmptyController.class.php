<?php
namespace Admin\Controller;
use Think\Controller;
class EmptyController extends BaseController{


    public function index(){
        $this->error(C('ERROR_404'),U('Index/index'));
    }

}