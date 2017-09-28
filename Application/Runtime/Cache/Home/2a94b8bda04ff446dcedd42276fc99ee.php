<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta id="viewport" name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<meta name="format-detection" content="telephone=no" />
	<meta name="description" content="这些都是真的！不要钱！通通0元抽啦！手机数码潮品爆款新款达人必备都想带走？没有问题！赶紧来抽吧，分享还可以获得更多抽奖机会哦。">
	<meta name="share-title" content="0元抽大奖，好运要分享！手机数码潮品爆款新款通通0元抽奖啦！">
	<title>0元抽</title>
	<link rel="stylesheet" type="text/css" href="/lyg/lys/Public/home/css/common.css">
	<link rel="stylesheet" type="text/css" href="/lyg/lys/Public/home/css/index.css">
	<link href="/static/css/carrotui/carrot.ui.css" rel="stylesheet" />
	<link href="/static/css/carrotui/carrot.ui.theme.css" rel="stylesheet" />
	<link href="/static/css/carrotui/iconfont.css" rel="stylesheet" />
	<script src="/static/script/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="/static/script/carrot.ui.js" type="text/javascript"></script>
	<script type="text/javascript" src="/lyg/lys/Public/home/js/count_down.js"></script>
</head>
<body class="cui-has-tabs">
<div id="bar_list">
	<div id="bar_list_div">
		<ul id="bar_list_ul">
			<!--正在进行中活动-->
			<?php if($activity_data_going != ''): if(is_array($activity_data_going)): $i = 0; $__LIST__ = $activity_data_going;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="ongoing">
						<a href="<?php echo U('Index/purchase');?>?activity_id=<?php echo ($vo["id"]); ?>" class="shopping">
							<div class="shop_content">
								<div class="shop">
									<img class="shop_image" src="<?php echo ($vo["products_images"]); ?>">
									<span class="status going">正在进行中</span>
								</div>
								<div class="shop_title">
									<p><span class="amount">第<?php echo ($vo["id"]); ?>期</span><span class="title_detail"><?php echo ($vo["product_name"]); ?></span></p>
									<p class="price">市场价:<span>￥<?php echo ($vo["market_price"]); ?></span></p>
									<a href="<?php echo U('Index/purchase');?>?activity_id=<?php echo ($vo["id"]); ?>" title="立即0元购"  class="purchase immediately">立即0元购</a>
								</div>
							</div>
							<div class="participation">
								<p class="time now_status" data-id="<?php echo ($vo["end_time"]); ?>"></p>
								<p class="participate_amount">
									<?php if($vo["now_code"] < 1): ?><span >0</span>人次已参与
									<?php else: ?>
										<span ><?php echo ($vo["now_code"]); ?></span>人次已参与<?php endif; ?>

								</p>
							</div>
						</a>
					</div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
			<!--明日预告活动-->
			<?php if($activity_data_notice != ''): if(is_array($activity_data_notice)): $i = 0; $__LIST__ = $activity_data_notice;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="advance_notice">
						<a href="<?php echo U('Index/purchase');?>?activity_id=<?php echo ($vo["id"]); ?>" class="shopping">
							<div class="shop_content">
								<div class="shop">
									<img class="shop_image" src="<?php echo ($vo["products_images"]); ?>">
									<span class="status foreshow">下期预告</span>
								</div>
								<div class="shop_title">
									<p><span class="amount">第<?php echo ($vo["id"]); ?>期</span><span class="title_detail"><?php echo ($vo["product_name"]); ?></span></p>
									<p class="price">市场价:<span>￥<?php echo ($vo["market_price"]); ?></span></p>
									<?php if($vo["winning_time"] < $date_time): ?><a href="<?php echo U('Index/purchase');?>?activity_id=<?php echo ($vo["id"]); ?>" title="今日<?php echo date('H:i',$vo['winning_time']);?>开始"  class="purchase notice">今日<?php echo date('H:i',$vo['winning_time']);?>开始</a>
									<?php else: ?>
										<a href="<?php echo U('Index/purchase');?>?activity_id=<?php echo ($vo["id"]); ?>" title="<?php echo date('Y-m-d H:i',$vo['winning_time']);?>开始"  class="purchase notice"><?php echo date('m-d H:i',$vo['winning_time']);?>开始</a><?php endif; ?>

								</div>
							</div>
							<div class="participation">
								<p class="time tomorrow_status" data-id="<?php echo ($vo["id"]); ?>"></p>
							</div>
						</a>
					</div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
			<!--等待开奖中活动-->
			<?php if($activity_data_await != ''): if(is_array($activity_data_await)): $i = 0; $__LIST__ = $activity_data_await;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="winning_lottery">
						<a href="<?php echo U('Index/purchase');?>?activity_id=<?php echo ($vo["id"]); ?>" class="shopping">
							<div class="shop_content">
								<div class="shop">
									<img class="shop_image" src="<?php echo ($vo["products_images"]); ?>">
									<span class="status wait">等待开奖中</span>
								</div>
								<div class="shop_title">
									<p><span class="amount">第<?php echo ($vo["id"]); ?>期</span><span class="title_detail"><?php echo ($vo["product_name"]); ?></span></p>
									<p class="price">市场价:<span>￥<?php echo ($vo["market_price"]); ?></span></p>
									<?php if($vo["winning_time"] < $date_time): ?><a href="<?php echo U('Index/purchase');?>?activity_id=<?php echo ($vo["id"]); ?>" title="今日<?php echo date('H:i',$vo['winning_time']);?>开奖"  class="purchase notice">今日<?php echo date('H:i',$vo['winning_time']);?>开奖</a>
										<?php else: ?>
										<a href="<?php echo U('Index/purchase');?>?activity_id=<?php echo ($vo["id"]); ?>" title="<?php echo date('Y-m-d H:i',$vo['winning_time']);?>开奖"  class="purchase notice"><?php echo date('m-d H:i',$vo['winning_time']);?>开奖</a><?php endif; ?>
								</div>
							</div>
							<div class="participation">
								<p class="time wait_status" data-id="<?php echo ($vo["id"]); ?>"></p>
								<p class="participate_amount">
									<?php if($vo["now_code"] < 1): ?><span >0</span>人次已参与
										<?php else: ?>
										<span ><?php echo ($vo["now_code"]); ?></span>人次已参与<?php endif; ?>
								</p>
							</div>
						</a>
					</div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
			<!--已结束的活动-->
			<!--瀑布流-->
			<?php if($activity_data != ''): if(is_array($activity_data)): $i = 0; $__LIST__ = $activity_data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="ongoing">
						<input type="hidden" name="last_id" class="last_id" value="<?php echo ($vo["id"]); ?>">
						<a href="<?php echo U('Index/purchase');?>?activity_id=<?php echo ($vo["id"]); ?>" class="shopping">
							<div class="shop_content">
								<div class="shop">
									<img class="shop_image" src="<?php echo ($vo["products_images"]); ?>">
									<?php if(($vo['winning_time'] < $now_time) and ($vo['winning_code'] == '')): ?><span class="status wait">等待开奖中</span>
									<?php else: ?>
										<span class="status finish">活动已结束</span><?php endif; ?>
								</div>
								<div class="shop_title">
									<p><span class="amount">第<?php echo ($vo["id"]); ?>期</span><span class="title_detail"><?php echo ($vo["product_name"]); ?></span></p>
									<p class="price">市场价:<span>￥<?php echo ($vo["market_price"]); ?></span></p>
									<?php if(($vo['winning_time'] < $now_time) and ($vo['winning_code'] == '')): ?><a href="<?php echo U('Index/purchase');?>?activity_id=<?php echo ($vo["id"]); ?>" title="等待开奖中"  class="purchase history">等待开奖中</a>
									<?php else: ?>
										<a href="<?php echo U('Index/purchase');?>?activity_id=<?php echo ($vo["id"]); ?>" title="查看中奖信息"  class="purchase history">查看中奖信息</a><?php endif; ?>

								</div>
							</div>
							<div class="participation">
								<?php if(($vo['winning_time'] < $now_time) and ($vo['winning_code'] == null)): ?><p class="time" data-id="<?php echo ($vo["id"]); ?>">等待开奖中</p>
								<?php else: ?>
									<p class="time" data-id="<?php echo ($vo["id"]); ?>">已结束</p><?php endif; ?>

								<p class="participate_amount">
									<?php if($vo["now_code"] < 1): ?><span >0</span>人次已参与
										<?php else: ?>
										<span ><?php echo ($vo["now_code"]); ?></span>人次已参与<?php endif; ?>
								</p>
							</div>
						</a>
					</div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
			<!--瀑布流-->
		</ul>
		<div class="up_down"><div id="up_arrow" class="up_down_arrow"></div><div id="up_text" class="up_down_text">上拉加载更多</div></div>
	</div>
</div>
<div class="cui-tabs">
	<ul>
		<li>
			<a href="http://www.loyoubao.com">
				<p class="cui-icon">&#xe608;</p >
				<span>首页</span>
			</a>
		</li>
		<li>
			<a href="http://new.yyyggo.com/" >
				<p class="cui-icon">&#xe609;</p >
				<span>1元云购</span>
			</a>
		</li>
		<li>
			<a href="/lyg/" class="active">
				<p class="cui-icon">&#xe60a;</p >
				<span>0元抽</span>
			</a>
		</li>
		<li>
			<a href="http://sso.loyoubao.com/users/" >
				<p class="cui-icon">&#xe600;</p >
				<span>我的</span>
			</a>
		</li>
	</ul>
</div>
</body>
<script src="/lyg/lys/Public/home/js/ai.js" type="text/javascript"></script>
<script src="/lyg/lys/Public/home/js/slip-min.js" type="text/javascript"></script>
<script>
	// 你可能会看到ai.js这个javascript文件，这个文件和slip.js无任何依赖关系，ai.js只是一些常用的函数如：ai.i，这些函数也有非常详细的注释。
	window.addEventListener('load', function(){
		ai.hideUrl();
		var bar_list_div = ai.i("bar_list_div"),
			bar_list     = ai.i("bar_list"),
			minus        = ai.ovb.ios() && ai.ovb.safari() && !ai.ovb.ipad() ? -20 : 40,
			up_arrow	 = ai.i("up_arrow"),
			up_text      = ai.i("up_text"),
			bar_list_ul  = ai.i("bar_list_ul");
			up_ing       = false,
			down_ing       = false,
			loadb       = false;
		bar_list.style.height =  ai.wh() - minus +"px";
		function update() {
			if(this.xy < -(this.coreWidth_cut_width + 20) && up_ing == false){
				up_ing = true;
				down_ing = false;
				up_arrow.style['webkitTransitionDuration'] = '300ms';
				up_arrow.style['webkitTransform'] = 'rotate(0deg)';
				up_text.innerHTML = "松开加载更多";
				loadb = true;
			}else if(this.xy > -(this.coreWidth_cut_width + 20) && down_ing == false){
				down_ing = true;
				up_ing = false;
				up_arrow.style['webkitTransitionDuration'] = '300ms';
				up_arrow.style['webkitTransform'] = 'rotate(-180deg)';
				up_text.innerHTML = "上拉加载更多";
				loadb = false;
			}
		}
		function loading() {
			if(loadb){
				loadb    = false;
				var that = this;
				var lastid = $('.last_id:last').val();

				up_text.innerHTML= 'Loading...';
				up_arrow.style['webkitTransitionDuration'] = '0ms';
				up_arrow.className += ' loading';
				setTimeout(function () {
					$.ajax("<?php echo u('Index/getMore');?>",{
						data:{lastid : lastid},
						success:function(data){
							if (data.length){
								var arr_total = '';
								for (var i =0; i< data.length; i++) {
									if (data[i]["winning_code"]){
										arr_total += '<div class="ongoing"><input type="hidden" name="last_id" class="last_id" value="'+data[i]["id"]+'"><a href="<?php echo U('Index/purchase');?>?activity_id='+data[i]["id"]+'" class="shopping"><div class="shop_content"><div class="shop"><img class="shop_image" src= "'+data[i]['images']+'"><span class="status finish">活动已结束</span></div><div class="shop_title"><p><span class="amount">第'+data[i]["id"]+'期</span><span class="title_detail">'+data[i]["product_name"]+'</span></p><p class="price">市场价:<span>￥'+data[i]["market_price"]+'</span></p><a href="<?php echo U('Index/purchase');?>?activity_id='+data[i]["id"]+'" title="查看中奖信息" id="purchase"  class="purchase history">查看中奖信息</a></div></div><div class="participation"><p class="time" data-id="'+data[i]["id"]+'">已结束</p><p class="participate_amount"><span >'+data[i]["now_code"]+'</span>人次已参与</p></div></a></div>';
									} else {
										arr_total += '<div class="ongoing"><input type="hidden" name="last_id" class="last_id" value="'+data[i]["id"]+'"><a href="<?php echo U('Index/purchase');?>?activity_id='+data[i]["id"]+'" class="shopping"><div class="shop_content"><div class="shop"><img class="shop_image" src= "'+data[i]['images']+'"><span class="status wait">等待开奖中</span></div><div class="shop_title"><p><span class="amount">第'+data[i]["id"]+'期</span><span class="title_detail">'+data[i]["product_name"]+'</span></p><p class="price">市场价:<span>￥'+data[i]["market_price"]+'</span></p><a href="<?php echo U('Index/purchase');?>?activity_id='+data[i]["id"]+'" title="等待开奖中" id="purchase"  class="purchase history">等待开奖中</a></div></div><div class="participation"><p class="time" data-id="'+data[i]["id"]+'">等待开奖中</p><p class="participate_amount"><span >'+data[i]["now_code"]+'</span>人次已参与</p></div></a></div>';
									}
								}
								var newli = arr_total;
								bar_list_ul.innerHTML += newli;
								up_arrow.style['webkitTransform'] = 'rotate(-180deg)';
								up_arrow.className = 'up_down_arrow';
								that.up_range = 0;
								that.refresh();
							} else {
//							加载完成执行的方法
							}
						}
					});
				}, 1000);
			}
		}
		var slipjs_yuxiang = slip('px', bar_list_div, {
			moveFun: update,
			endFun: loading
		});
	});
//	计时器的设定
	var end_time;
	var str_end_time = "<?php echo ($str_end_time); ?>";
	$str_end_time = str_end_time.split(",");
	$(".now_status").each(function(i){
		$(this).attr('id','end_time'+i);
		end_time = "end_time"+i;
		$("#end_time").countDown({
			date_time:$str_end_time[i],
			sign:'活动结束',
			txt_id:end_time
		})
	});
	var start_time;
	var str_start_time = "<?php echo ($str_start_time); ?>";
	$str_start_time = str_start_time.split(",");
	$(".tomorrow_status").each(function(i){
		$(this).attr('id','start_time'+i);
		start_time = "start_time"+i;
		$("#start_time").countDown({
			date_time:$str_start_time[i],
			sign:'活动开始',
			txt_id:start_time
		})
	});
	var winning_time;
	var str_winning_time = "<?php echo ($str_await_time); ?>";
	$str_winning_time = str_winning_time.split(",");
	$(".wait_status").each(function(i){
		$(this).attr('id','winning_time'+i);
		winning_time = "winning_time"+i;
		$("#o").countDown({
			date_time:$str_winning_time[i],
			sign:'开奖',
			txt_id:winning_time
		})
	});
</script>
</html>