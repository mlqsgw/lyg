<?php
//单点登录演示程序
date_default_timezone_set('PRC');
header('Content-type: text/html; charset=utf-8');

require('include/carrot.sso.php');

CarrotSSO::start_session();
if (!isset($_SESSION['user'])) {  //如果用户SESSION不存在，尝试SSO登录
	$user_info = CarrotSSO::auth();
	if (isset($user_info)) {
		$_SESSION['user'] = $user_info;  //分配SESSION
	} else {
		//TODO: 无法通过授权获取用户资料，输出错误页面或重定向到其他不需要登录的页面
		echo '单点登录失败';
		exit;
	}
} else {
	$user_info = $_SESSION['user'];
}

echo '从这里开始以下是登录后显示的页面';
print_r($user_info);