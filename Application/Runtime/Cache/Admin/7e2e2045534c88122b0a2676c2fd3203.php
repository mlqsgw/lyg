<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="/thinkphp/Public/admin/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/thinkphp/Public/admin/js/jquery.js"></script>

</head>


<body>

	<div class="place">
    <span>位置：</span>
    <ul class="placeul">
    <li><a href="#">首页</a></li>
    </ul>
    </div>
    
    <div class="mainindex">
    
    
    <div class="welinfo">
    <span><img src="/thinkphp/Public/admin/images/sun.png" alt="天气" /></span>
    <b><?php echo $admin_name;?>&nbsp;您好！欢迎使用信息管理系统</b>(admin@uimaker.com)
    </div>
    
    <div class="welinfo">
    <span><img src="/thinkphp/Public/admin/images/time.png" alt="时间" /></span>
    <i>您上次登录的时间：<?php echo date("Y-m-d H:i:s",$last_login_time);?></i> 

    <img src="/thinkphp/Public/admin/images/ip_adress.png" alt="IP" />
    <i>您上次登录的IP地址：<?php echo $last_login_ip;?></i> （不是您登录的？<a href="#">请点这里</a>）
    
</div>

 
    <div class="xline"></div>
    <div class="box"></div>
    
    <div class="welinfo">
    <span><img src="/thinkphp/Public/admin/images/dp.png" alt="提醒" /></span>
    <b>绘本统计</b>
    </div>
    
    <ul class="infolist">
    <li><span>总绘本数量</span><a class="ibtn"><?php echo $total;?></a></li>
    <li><span>已借出绘本数量</span><a class="ibtn"><?php echo $yijie;?></a></li>
    <li><span>未借阅绘本数量</span><a class="ibtn"><?php echo $weijie;?></a></li>
    </ul>
    
    <div class="xline"></div>

   
    
    </div>
    
    

</body>

</html>