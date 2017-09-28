<?php
//转让订单演示程序
date_default_timezone_set('PRC');
header('Content-type: text/html; charset=utf-8');

require('include/carrot.orders.php');

$order = new CarrotOrders();
$order->order(2);  //设置订单ID
$result = $order->transfer('18989893693');  //转让给用户的手机号码
print_r($result);
unset($order);