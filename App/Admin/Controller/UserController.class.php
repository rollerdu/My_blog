<?php
namespace Admin\Controller;
use Admin\Controller;
/**
 * 前台用户管理
 */
class UserController extends BaseController {

    /**
     * 用户列表
     * @return [type] [description]
     */
    public function index($key="")
    {
        if($key == ""){
            $model = M('user');
        }else{
            $where['mobile'] = array('like',"%$key%");
            $where['email'] = array('like',"%$key%");
            $where['_logic'] = 'or';
            $model = M('user')->where($where);
        }

        $count  = $model->where($where)->count();// 查询满足要求的总记录数
        $Page = new \Extend\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出
        $user = $model->limit($Page->firstRow.','.$Page->listRows)->where($where)->order('id DESC')->select();
        $this->assign('user', $user);
        $this->assign('page',$show);
        $this->display();
    }

    /**
     * 添加用户
     */
    public function add()
    {
        //默认显示添加表单
        if (!IS_POST) {
            $this->display();
        }
        if (IS_POST) {
            //如果用户提交数据
            $model = D("user");

            if (!$model->create()) {
                // 如果创建失败 表示验证没有通过 输出错误提示信息
                $this->error($model->getError());
                exit();
            } else {
                if ($insertid = $model->add()){
                    //$model->
                    //更新用户uuid
                    $data['uuid'] = set_user_uuid($insertid,1);
                    $model->where("id={$insertid}")->save($data);

                    $this->success("用户添加成功", U('user/index'));
                } else {
                    $this->error("用户添加失败");
                }
            }
        }
    }
    /**
     * 更新用户信息
     * @param  [type] $id [用户ID]
     * @return [type]     [description]
     */
    public function update()
    {
        //默认显示添加表单
        if (!IS_POST) {
            $model = M('user')->find(I('id'));
            $this->assign('model',$model);
            $this->display();
        }
        if (IS_POST) {
            $model = D("user");
            if (!$model->create()) {
                $this->error($model->getError());
            }else{
                //验证密码是否为空
                $data = I();
                unset($data['password']);
                if(I('password') != ""){
                    $data['password'] = md5(I('password'));
                }
                //强制更改超级用户用户类型
                if(C('SUPER_ADMIN_ID') == I('id')){
                    $data['type'] = 2;
                }
                //更新
                if ($model->save($data)) {
                    $this->success("用户信息更新成功", U('user/index'));
                } else {
                    $this->error("未做任何修改,用户信息更新失败");
                }
            }
        }
    }
    /**
     * 删除用户
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function delete($id)
    {
    	if(C('SUPER_ADMIN_ID') == $id) $this->error("超级用户不可禁用!");
        $model = M('user');
        //查询status字段值
        $result = $model->find($id);
        //更新字段
        $data['id']=$id;
        if($result['status'] == 1){
        	$data['status']=0;
        }
        if($result['status'] == 0){
        	$data['status']=1;
        }
        if($model->save($data)){
            $this->success("状态更新成功", U('user/index'));
        }else{
            $this->error("状态更新失败");
        }
    }


    /**
     * 修改用户信息
     * @param  [type] $id [用户ID]
     * @return [type]     [description]
     */
    public function pw() {

        $data['id'] = $this->user['id'];
        if (IS_POST) {
            $model = D("user");
            if (!$model->create()) {
                $this->error($model->getError());
            }else{
                $password = I('password');
                $password1 = I('password1');
                $password2 = I('password2');
                $oldpassword = $this->user['password'];
                if ($oldpassword != md5($password)) {
                    $this->error("原始密码错误！");
                } else {
                    if (!empty($password1) || !empty($password2)) {
                        if ($password1 != $password2) {
                            $this->error("两次密码输入不一致！");
                        } else {
                            $data['password'] = md5($password1);
                        }
                    } else {
                        $this->error("新密码不能为空！");

                    }

                }

                //更新
                if ($model->save($data)) {
                    session('adminManage',null);
                    $this->success("用户信息更新成功", U('user/pw'));
                } else {
                    $this->error("未做任何修改,用户信息更新失败");
                }
            }
        } else {
            $this->display();

        }
    }

}
