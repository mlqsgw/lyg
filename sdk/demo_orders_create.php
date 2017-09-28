<?php
//创建订单演示程序
date_default_timezone_set('PRC');
header('Content-type: text/html; charset=utf-8');

require('include/carrot.orders.php');

$data = array(
	'user_id' => 1,  //用户ID
	'caption' => '云购第XXX期中奖商品',  //订单标题
	'product' => 1,  //商品ID
	'memo' => '',  //订单备注内容(可选)
	'type' => 0,  //0:普通订单 1:自动发货卡密类(可选，默认0)
	'card_type' => 0  //卡类类型ID，如果type为1必须提供此参数
);

$order = new CarrotOrders();
$result = $order->create($data);
print_r($result);
unset($order);