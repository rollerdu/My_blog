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
<![endif]--><title>中奖者列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 抽奖管理 <span class="c-gray en">&gt;</span> 中奖者列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<form action="<?php echo U('Award/index');?>" method="get">
		<div class="text-c">
			<input type="text" name="mobile" value="<?php echo ($mobile); ?>" placeholder="用户手机号" style="width:250px" class="input-text">
			<button id="search" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜索</button>
		</div>
	</form>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"></span> <span class="r">共有数据：<strong><?php echo ($count); ?></strong> 条</span> </div>
	<table class="table table-border table-bordered table-hover table-bg">
		<thead>
			<tr>
				<th scope="col" colspan="9">中奖者列表</th>
			</tr>
			<tr class="text-c">
				<th width="40">ID</th>
				<!--<th width="80">中奖人名称</th>-->
				<th width="100">手机号</th>
				<!--<th width="220">openID</th>-->
				<th width="60">奖品ID</th>
				<th width="250">奖品</th>
				<th>奖品描述</th>
				<th width="150">中奖时间</th>
				<th width="60">状态</th>
				<th width="120">操作</th>
			</tr>
		</thead>
		<tbody>
		<?php if(is_array($data)): foreach($data as $key=>$v): ?><tr class="text-c">
				<td><?php echo ($v["id"]); ?></td>
				<!--<td><?php echo ($v["name"]); ?></td>-->
				<td><?php echo ($v["mobile"]); ?></td>
				<!--<td><?php echo ($v["openid"]); ?></td>-->
				<td><?php echo ($v["awid"]); ?></td>
				<td><?php echo ($v["award"]); ?></td>
				<td><?php echo ($v["intro"]); ?></td>
				<td><?php echo ($v["ctime"]); ?></td>
				<td class="td-status"><span class="label label-<?php echo ($v['status'] ? 'danger':'success'); ?> radius"><?php echo ($v['status'] ? '已领取':'未领取'); ?></span></td>
				<td class="f-14">
                    <?php if($v['status'] == 0): ?><a title="领取奖品" href="javascript:;" onclick="admin_role_edit(this,'<?php echo ($v["id"]); ?>')" style="text-decoration:none">
						<i class="Hui-iconfont">&#xe669;</i>
					</a>
                        <?php else: ?>
                        <a title="奖品已领取" style="text-decoration:none">
                            <i class="Hui-iconfont">&#xe6a9;</i>
                        </a><?php endif; ?>
					<a title="删除" href="javascript:;" onclick="winners_del(this,'<?php echo ($v["id"]); ?>')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>
				</td>
			</tr><?php endforeach; endif; ?>
		</tbody>
	</table>
	<div style="float:right;"><?php echo ($page); ?></div>
</div>
<script type="text/javascript" src="/Public/admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/Public/admin/lib/layer/2.1/layer.js"></script> 
<script type="text/javascript" src="/Public/admin/lib/My97DatePicker/WdatePicker.js"></script> 
<script type="text/javascript" src="/Public/admin/static/h-ui/js/H-ui.js"></script> 
<script type="text/javascript" src="/Public/admin/static/h-ui.admin/js/H-ui.admin.js"></script> 
<script type="text/javascript">
function admin_role_edit(obj,id){
	layer.confirm('确定要修改为已领取吗？',function(index){
        var url = "<?php echo U('Award/winners_status');?>";
		//此处请求后台程序，下方是成功后的前台处理……
		$.get(url,{id:id},function(data){
			if(data.status == 1){
                $(obj).parents("tr").find(".td-status").html('<span class="label label-danger radius">已领取</span>');
                $(obj).removeAttr('onclick');
                $(obj).children(".Hui-iconfont").html('').addClass('Hui-iconfont-yiguanzhu1');
				layer.msg(data.info,{icon:1,time:1000});
			}else{
				layer.msg(data.info,{icon:2,time:1000});
			}

		});
		


	});
}
function winners_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$.get('<?php echo U("Award/winner_delete");?>',{id:id},function(data){
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