<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="/thinkphp/Public/admin/css/style.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="/thinkphp/Public/admin/js/jquery.js"></script>
<script type="text/javascript">
$(function(){	
	//顶部导航切换
	$(".nav li a").click(function(){
		$(".nav li a.selected").removeClass("selected")
		$(this).addClass("selected");
	})	
})	
</script>


</head>

<body style="background:url(/thinkphp/Public/admin/images/topbg.gif) repeat-x;">

    <div class="topleft">
    <a href="main.html" target="_parent"><img src="/thinkphp/Public/admin/images/logo.png" title="系统首页" /></a>
    </div>
        
    <ul class="nav">
    <li>
    <!-- <a href="default.html" target="rightFrame" class="selected">
    <img src="/thinkphp/Public/admin/images/icon01.png" title="工作台" /><h2>工作台</h2></a></li>
    <li>
    <a href="imgtable.html" target="rightFrame">
    <img src="/thinkphp/Public/admin/images/icon02.png" title="模型管理" /><h2>模型管理</h2></a></li>
    <li><a href="imglist.html"  target="rightFrame">
    <img src="/thinkphp/Public/admin/images/icon03.png" title="模块设计" /><h2>模块设计</h2></a></li>
    <li><a href="tools.html"  target="rightFrame">
    <img src="/thinkphp/Public/admin/images/icon04.png" title="常用工具" /><h2>常用工具</h2></a></li>
    <li><a href="computer.html" target="rightFrame">
    <img src="/thinkphp/Public/admin/images/icon05.png" title="文件管理" /><h2>文件管理</h2></a></li>
    <li><a href="tab.html"  target="rightFrame">
    <img src="/thinkphp/Public/admin/images/icon06.png" title="系统设置" /><h2>系统设置</h2></a> --></li>
    </ul>
            
    <div class="topright">    
    <ul>
    <li><a href="/thinkphp/admin/index/logout" target="_parent">安全退出</a></li>
    </ul>
     
    <div class="user">
    <span>admin</span>
    </div>    
    
    </div>

</body>
</html>