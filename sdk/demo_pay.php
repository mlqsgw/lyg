<?php
//重定向到支付通道(只支持GET参数传递)
date_default_timezone_set('PRC');
header('Content-type: text/html; charset=utf-8');

define('THIS_DIR', dirname(__FILE__));
require('include/carrot.payment.php');

$pay = new CarrotPayment();

//TODO: 在处理支付前先验证用户是否登录，如未登录则跳转到登录流程
$user_id = 1;  //通过验证获取用户ID

//TODO: 在这里生成订单，并获取到如下信息
$order_id = $pay->make_order_id('TEST');  //订单的ID号，在此DEMO中使用make_order_id()生成随机订单号
$order_code = $pay->make_random_code();  //订单的随机码，在此DEMO中使用可用make_random_code()生成随机订单号
$amount = 1;  //订单金额

$params = array(
	'user_id' => $user_id,  //必填数字***  支付用户的ID
	'description' => '订单描述TEST',  //必填50字符以内***  订单描述(内部使用)
	'goods_id' => '00001',  //必填***  商品编号
	'goods_name' => 'iPhone6s 32G',  //必填***  商品名称
	'goods_type' => '虚拟商品',  //必填***  商品分类
	'amount' => $amount,  //必填数字***  支付金额
	'pay_purposes' => 2,  //账户充值，固定值2
	'order_code' => $order_code,  //必填32byte以内字母数字***  订单随机码，用于支付后通知回调验证(唯一，内部使用)
	'order_id' => $order_id,  //必填50byte以内字母数字***   订单号(唯一，内部使用)
	'notify_url' => '',  //支付成功后台的回调地址，会带上请求支付时的GET参数order_id和order_code。不填写则不回调
	'return_url' => 'http://127.0.0.1/demo_pay_return.php'  //必填***  支付成功前台回调地址
);
$pay->pay($params);  //开始支付