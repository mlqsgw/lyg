<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>无标题文档</title>
	<link href="/thinkphp/Public/admin/css/style.css" rel="stylesheet" type="text/css" />
	<link href="/thinkphp/Public/admin/css/select.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="/thinkphp/Public/admin/js/jquery.js"></script>
	<script type="text/javascript" src="/thinkphp/Public/admin/js/jquery.idTabs.min.js"></script>
	<script type="text/javascript" src="/thinkphp/Public/admin/js/select-ui.min.js"></script>


	<script type="text/javascript">
		$(document).ready(function(e) {
			$(".select1").uedSelect({
				width : 345
			});

		});
	</script>

</head>

<body>

<div class="place">
	<span>位置：</span>
	<ul class="placeul">
		<li><a href="/thinkphp/Admin/Index/main">首页</a></li>
		<li><a href="javascript:;">管理员管理</a></li>
	</ul>
</div>

<div class="formbody">


	<div id="usual1" class="usual">

		<div class="itab">
			<ul>
				<li><a href="#tab2" class="selected">管理员列表</a></li>
				<li><a href="#tab1" >添加管理员</a></li>

			</ul>
		</div>


		<!--管理员添加-->
		<div id="tab1" class="tabson">
			<div class="formtext">
				Hi，<b>超级管理员</b>，欢迎您使用管理员管理！
			</div>
			<form method='post' action="/thinkphp/admin/admin/admin_add">
				<ul class="forminfo">

					<li>
						<label>用户名<b>*</b></label>
						<input name="admin_name" type="text" class="dfinput"  style="width:518px;"/><i>此为登录名，一经填写不可更改</i>
					</li>
					<li>
						<label>密码<b>*</b></label>
						<input name="admin_password" type="text" class="dfinput"  style="width:518px;" value="123" /><i>初始密码为：123</i>
					</li>

					<li>
						<label>邮箱<b>*</b></label>
						<input name="admin_email" type="text" class="dfinput" style="width:518px;"/><i>请认真填写邮箱，可用于密码找回</i>
					</li>
					<li><label>是否启用</label>
						<cite>
							<input name="status" type="radio" value="0" checked="checked" />否
							&nbsp;&nbsp;&nbsp;&nbsp;
							<input name="status" type="radio" value="1" />是
						</cite>
					</li>
					<li><label>&nbsp;</label>
						<input name="sub" type="submit" class="btn" value="马上发布"/></li>
				</ul>
			</form>
		</div>


		<!--管理员列表-->
		<div id="tab2" class="tabson">
			<table class="tablelist">
				<thead>
				<tr>
					<th>编号</th>
					<th>用户名</th>
					<th>邮箱</th>
					<th>登陆次数</th>
					<th>添加时间</th>
					<th>是否启用</th>
					<th>操作</th>
				</tr>
				</thead>
				<tbody>
				<?php foreach($admin_list as $key=>$val):?>
				<tr>
					<td><?php echo $val['admin_id'];?></td>
					<td><?php echo $val['admin_name'];?></td>
					<td><?php echo $val['admin_email'];?></td>
					<td><?php echo $val['login_count'];?></td>
					<td><?php echo date("Y-m-d H:i:s",$val['add_time']);?></td>
					<td>
						<?php if($val['status'] == 0):?>
						<span>未启用</span>
						<?php elseif($val['status'] == 1):?>
						<span>已启用</span>
						<?php endif;?>

					</td>
					<td>
						<a href="/thinkphp/admin/admin/admin_exit?admin_id=<?php echo $val['admin_id'];?>" class="tablelink">编辑</a>
						<?php if($val['admin_id'] !=1):?>
						<a href="/thinkphp/admin/admin/admin_delete?admin_id=<?php echo $val['admin_id'];?>" class="tablelink"  onclick="return confirm('确定删除吗？')"> 删除</a>
						<?php endif;?>

					</td>
				</tr>
				<?php endforeach;?>
				</tbody>
			</table>




		</div>

	</div>


</div>



<script type="text/javascript">
	$("#usual1 ul").idTabs();
</script>

<script type="text/javascript">
	$('.tablelist tbody tr:odd').addClass('odd');
</script>
</body>

</html>