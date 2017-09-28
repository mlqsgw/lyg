<?php
//发送短信演示程序
date_default_timezone_set('PRC');
header('Content-type: text/html; charset=utf-8');

require('include/carrot.message.php');

$code = (string)rand(1000,9999);
$data = array($code, '60');  //发送内容为数组，元素与消息模板中的标记一一对应

$msg = new CarrotMessage();
//发送给指定手机号 SUCCESS 成功 / FAIL 失败
echo $msg->send_sms2phone('18357310001', 1, $data, $msg->get_ip());  //参数1:接收的手机号; 参数2:消息模板ID; 参数3:内容数组; 参数4:发送者IP（与发送限制有关）
//发送给指定用户 SUCCESS 成功 / FAIL 失败
echo $msg->send_sms(1, 1, $data, $msg->get_ip());  //参数1:接收的用户ID; 参数2:消息模板ID; 参数3:内容数组; 参数4:发送者IP（与发送限制有关）
