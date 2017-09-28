<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="/thinkphp/Public/admin/css/style.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="/thinkphp/Public/admin/js/jquery.js"></script>

<script type="text/javascript">
$(function(){	
	//导航切换
	$(".menuson li").click(function(){
		$(".menuson li.active").removeClass("active")
		$(this).addClass("active");
	});
	
	$('.title').click(function(){
		var $ul = $(this).next('ul');
		$('dd').find('ul').slideUp();
		if($ul.is(':visible')){
			$(this).next('ul').slideUp();
		}else{
			$(this).next('ul').slideDown();
		}
	});
})	
</script>

</head>
<body style="background:#f0f9fd;">
	<div class="lefttop"><span></span>0元购后台管理</div>
    
    <dl class="leftmenu">
        
    <dd>
    
    <dd>
    <div class="title">
    <span><img src="/thinkphp/Public/admin/images/leftico02.png" /></span>管理员管理
    </div>
    <ul class="menuson">
    <li><cite></cite><a href="/thinkphp/Admin/Admin/admin_list" target="rightFrame">管理员列表</a><i></i></li>
    </ul>
    </dd> 

    <dd><div class="title"><span><img src="/thinkphp/Public/admin/images/leftico03.png" /></span>活动管理</div>
    <ul class="menuson">
        <li><cite></cite><a href="/thinkphp/Admin/Picture/picture_list" target="rightFrame">活动列表</a><i></i></li>
    </ul>    
    </dd>  

    <dd><div class="title"><span><img src="/thinkphp/Public/admin/images/leftico03.png" /></span>会员管理</div>
    <ul class="menuson">
        <li><cite></cite><a href="/thinkphp/Admin/User/user_list" target="rightFrame">会员列表</a><i></i></li>
    </ul>    
    </dd>  

    </dl>
    
</body>
</html>