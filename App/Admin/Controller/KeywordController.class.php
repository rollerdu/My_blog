<?php
namespace Admin\Controller;
use Admin\Controller;

/**
 * Note:屏蔽词管理
 * 
 * Author: Eddy
 * $id: keyword.php 2016-09-15 11:32 $
 */

class KeywordController extends BaseController
{


	public function index() {
		$dir = ROOT_PATH.'/Public/js/keywords.js';
		if (IS_POST) {
			$keyword = stripslashes($_POST['keyword']);
			$keyword = str_replace(array('<br />',"\r\n", "\n", "\r"),'',$keyword);
			$keyword = str_replace(array('，'),',',$keyword);
			$str = "var keywords = new Array(".$keyword.");";
			file_put_contents($dir,$str);
            $this->success("用户添加成功", U('Keyword/index'));
		}
		
		$explodeArr = array();
		$lines = file_get_contents($dir);
		preg_match('/([^\(]*?)\)/',$lines, $matches);
        $this->assign('keywords',$matches[1]);
        $this->display();
	}
}

?>