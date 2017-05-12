<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="/Public/admin/lib/html5.js"></script>
<script type="text/javascript" src="/Public/admin/lib/respond.min.js"></script>
<script type="text/javascript" src="/Public/admin/lib/PIE_IE678.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/Public/admin/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="/Public/admin/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/Public/admin/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/Public/admin/lib/Hui-iconfont/1.0.7/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/Public/admin/lib/icheck/icheck.css" />
<link rel="stylesheet" type="text/css" href="/Public/admin/lib/icheck/jquery.icheck.min.js" />
<link rel="stylesheet" type="text/css" href="/Public/admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/Public/admin/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]--><title>角色列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 管理员管理 <span class="c-gray en">&gt;</span> 角色管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="cl pd-5 bg-1 bk-gray"> <span class="l"><a class="btn btn-primary radius" href="javascript:;" onclick="admin_role_add('添加角色','<?php echo U('Role/add');?>','800')"><i class="Hui-iconfont">&#xe600;</i> 添加角色</a> </span> <span class="r">共有数据：<strong><?php echo count($roles);?></strong> 条</span> </div>
	<table class="table table-border table-bordered table-hover table-bg">
		<thead>
			<tr>
				<th scope="col" colspan="6">角色管理</th>
			</tr>
			<tr class="text-c">
				<th width="40">ID</th>
				<th width="200">角色名</th>
				<th>用户列表</th>
				<th width="400">描述</th>
				<th width="50">状态</th>
				<th width="120">操作</th>
			</tr>
		</thead>
		<tbody>
		<?php if(is_array($roles)): foreach($roles as $key=>$v): ?><tr class="text-c">
				<td><?php echo ($v["id"]); ?></td>
				<td><?php echo ($v["name"]); ?></td>
				<td><?php echo ($v["member"]); ?></td>
				<td><?php echo ($v["remark"]); ?></td>
				<td><?php echo ($v['status'] ? '正常':'禁用'); ?></td>
				<td class="f-14"><a title="权限设置" href="javascript:;" onclick="admin_role_edit('权限设置','<?php echo U('Role/authorize',array('id'=>$v['id']));?>')" style="text-decoration:none"><i class="Hui-iconfont">&#xe62e;</i></a> <a title="编辑" href="javascript:;" onclick="admin_role_edit('角色编辑','<?php echo U('Role/edit',array('id'=>$v['id']));?>')" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a title="删除" href="javascript:;" onclick="admin_role_del(this,'<?php echo ($v["id"]); ?>')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
			</tr><?php endforeach; endif; ?>
			<!--<tr class="text-c">-->
				<!--<td><input type="checkbox" value="" name=""></td>-->
				<!--<td>2</td>-->
				<!--<td>总编</td>-->
				<!--<td><a href="#">张三</a></td>-->
				<!--<td>具有添加、审核、发布、删除内容的权限</td>-->
				<!--<td class="f-14"><a title="编辑" href="javascript:;" onclick="admin_role_edit('角色编辑','admin-role-add.html','2')" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a title="删除" href="javascript:;" onclick="admin_role_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>-->
			<!--</tr>-->
			<!--<tr class="text-c">-->
				<!--<td><input type="checkbox" value="" name=""></td>-->
				<!--<td>3</td>-->
				<!--<td>栏目主辑</td>-->
				<!--<td><a href="#">李四</a>，<a href="#">王五</a></td>-->
				<!--<td>只对所在栏目具有添加、审核、发布、删除内容的权限</td>-->
				<!--<td class="f-14"><a title="编辑" href="javascript:;" onclick="admin_role_edit('角色编辑','admin-role-add.html','3')" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a title="删除" href="javascript:;" onclick="admin_role_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>-->
			<!--</tr>-->
			<!--<tr class="text-c">-->
				<!--<td><input type="checkbox" value="" name=""></td>-->
				<!--<td>4</td>-->
				<!--<td>栏目编辑</td>-->
				<!--<td><a href="#">赵六</a>，<a href="#">钱七</a></td>-->
				<!--<td>只对所在栏目具有添加、删除草稿等权利。</td>-->
				<!--<td class="f-14"><a title="编辑" href="javascript:;" onclick="admin_role_edit('角色编辑','admin-role-add.html','4')" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a title="删除" href="javascript:;" onclick="admin_role_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>-->
			<!--</tr>-->
		</tbody>
	</table>
</div>
<script type="text/javascript" src="/Public/admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/Public/admin/lib/layer/2.1/layer.js"></script> 
<script type="text/javascript" src="/Public/admin/lib/My97DatePicker/WdatePicker.js"></script> 
<script type="text/javascript" src="/Public/admin/static/h-ui/js/H-ui.js"></script> 
<script type="text/javascript" src="/Public/admin/static/h-ui.admin/js/H-ui.admin.js"></script> 
<script type="text/javascript">
/*管理员-角色-添加*/
function admin_role_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*管理员-角色-编辑*/
function admin_role_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}
/*管理员-角色-权限设置*/
function admin_role_authorize(title,url,w,h){
    layer_show(title,url,w,h);
}
/*管理员-角色-删除*/
function admin_role_del(obj,id){
	layer.confirm('角色删除须谨慎，确认要删除吗？',function(index){
        var url = "<?php echo U('Role/delete');?>";
		//此处请求后台程序，下方是成功后的前台处理……
		$.get(url,{id:id},function(data){
			if(data.status == 1){
				$(obj).parents("tr").remove();
				layer.msg(data.info,{icon:1,time:1000});
			}else{
				layer.msg(data.info,{icon:2,time:1000});
			}

		});
		


	});
}
</script>

<!-- JavaScript -->
</body>
</html>