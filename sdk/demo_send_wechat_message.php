<?php
//推送微信消息演示程序
date_default_timezone_set('PRC');
header('Content-type: text/html; charset=utf-8');

require('include/carrot.message.php');

$amount = 1;
$data = array('http://sso.yyyggo.com/', '00000000', '测试商品', $amount, '￥' . round($amount/100, 2), '商品购买成功，点击查看详情');  //发送内容为数组，元素与消息模板中的标记一一对应

$msg = new CarrotMessage();
//推送微信消息给指定openid SUCCESS 成功 / FAIL 失败
echo $msg->send_wechat_message2openid('o4GZ_wL-gtFL2dsiXbqczutGFTHw', 2, $data, $msg->get_ip());  //参数1:微信用户openid; 参数2:消息模板ID; 参数3:内容数组; 参数4:发送者IP（与发送限制有关）
//推送微信消息给指定用户 SUCCESS 成功 / FAIL 失败
echo $msg->send_wechat_message(1, 2, $data, $msg->get_ip());  //参数1:接收的用户ID; 参数2:消息模板ID; 参数3:内容数组; 参数4:发送者IP（与发送限制有关）
