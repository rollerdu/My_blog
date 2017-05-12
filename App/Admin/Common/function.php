<?php

/**
 * 根据id，返回分类名
 * @param $id
 * @return string
 */
function getCategoryTitle( $id ){
    $data = M('category')->field('title')->where('id='.$id)->find();
    if( $data )
        return $data['title'];
    else
        return '';
}

/**
 * 根据id，返回管理用户名
 * @param $id
 * @return stringk
 */
function getMemberUserName( $id ){
    $data = M('member')->field('username')->where('id='.$id)->find();
    if( $data )
        return $data['username'];
    else
        return '';
}

/**
 * 根据id，返回用户名
 * @param $id
 * @return stringk
 */
function getUserUserName( $id ){
    $data = M('user')->field('mobile')->where('uuid='.$id)->find();
    if($data){
        return $data['mobile'];
    }else{
        return '';
	}
}
/**
 * 根据id，返回业务分类名
 * @param $id
 * @return stringk
 */
function getBusiness( $id ){
    $data = M('business')->field('name')->where('id='.$id)->find();
    if($data){
        $set = $data['name'];
    }else{
        $set = '';
	}
	return $set;
}

/**
 * 根据id，返回业务二级名称
 * @param $id
 * @return stringk
 */
function getBusine($id){
    $data = M('business')->field('name')->where('pid='.$id)->select();
    if($data){
		foreach($data as $v) { 
			echo "├─".$v['name']."</br>";
		}
    }
}

function get_current_admin_id(){
    return $_SESSION['adminManage']['id'];
}
function get_admin_role_id(){
    return $_SESSION['adminManage']['role_id'];
}
/**
 *   获取菜单深度
 * @ param $id
 * @ param $array
 * @ param $i
 */
function _get_level($id, $array = array(), $i = 0) {

    if ($array[$id]['parentid']==0 || empty($array[$array[$id]['parentid']]) || $array[$id]['parentid']==$id){
        return  $i;
    }else{
        $i++;
        return _get_level($array[$id]['parentid'],$array,$i);
    }

}