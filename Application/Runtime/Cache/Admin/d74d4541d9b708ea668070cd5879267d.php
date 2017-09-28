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
		<li><a href="javascript:;">管理员修改</a></li>
	</ul>
</div>
<div class="formbody">
	<div id="usual1" class="usual">
		<!--管理员修改-->
		<div  class="tabson">
			<form method='post' action="/thinkphp/admin/admin/admin_exit_send">
				<input type="hidden"  name="admin_id" value="<?php echo $admin_mes['admin_id'];?>">
				<ul class="forminfo">

					<li>
						<label>用户名<b>*</b></label>
						<input name="admin_name" type="text" class="dfinput"  style="width:518px;" value="<?php echo $admin_mes['admin_name'];?>" disabled/><i>此为登录名，不可更改</i>
					</li>
					<li>
						<label>邮箱<b>*</b></label>
						<input name="admin_email" type="text" class="dfinput" style="width:518px;" value="<?php echo $admin_mes['admin_email'];?>" /><i>请认真填写邮箱，可用于密码找回</i>
					</li>
					<li><label>是否启用</label>
						<cite>
							<input name="status" type="radio" value="0" <?php if($admin_mes['status'] == 0):?>checked<?php endif;?> />否
							&nbsp;&nbsp;&nbsp;&nbsp;
							<input name="status" type="radio" value="1" <?php if($admin_mes['status'] == 1):?>checked<?php endif;?>  />是
						</cite>
					</li>
					<li><label>&nbsp;</label>
						<input name="sub" type="submit" class="btn" value="马上发布"/></li>
				</ul>
			</form>
		</div>

	</div>


</div>


</body>

</html>