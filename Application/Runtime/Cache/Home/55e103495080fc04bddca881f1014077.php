<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no,width=device-width"/>
	<meta name="description" content="重大消息:大奖免费抽啦,我刚参与了0元抽<?php echo ($activity_data["product_name"]); ?>活动，每天0元抽免费中大奖，手机、千足金、饰品等送不停，不要钱白送啦、不要钱白送啦、不要钱白送啦，重要的事情要说三遍。你也赶紧来试试吧！！！" />
	<meta name="share-title" content="0元中大奖，手机数码潮品爆款新款通通0元抽奖啦！" />
	<meta name="share-image" content="<?php echo ($activity_data["images"]); ?>"/>
	<title>0元抽</title>
	<link rel="stylesheet" type="text/css" href="/lyg/lys/Public/home/css/common.css">
	<link rel="stylesheet" type="text/css" href="/lyg/lys/Public/home/css/iconfont.css">
	<link href="/lyg/lys/Public/static/css/carrotui/carrot.ui.css" rel="stylesheet" />
	<link href="/lyg/lys/Public/static/css/carrotui/carrot.ui.theme.css" rel="stylesheet" />
	<link href="/lyg/lys/Public/static/css/carrotui/iconfont.css" rel="stylesheet" />
	<script src="/lyg/lys/Public/static/script/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="/lyg/lys/Public/static/script/carrot.ui.js" type="text/javascript"></script>
	<script type="text/javascript" src="/lyg/lys/Public/home/js/count_down.js"></script>
</head>
<body class="cui-has-tabs">
<script type="text/javascript">
	CarrotWechat.setShare(function () {
		var activity_id = $(".share").attr('activity_id');
		$.ajax("<?php echo u('Index/transpond');?>",{
			data:{activity_id : activity_id},
			success : function(data){
				if (data["status"]) {
					$.ajax("<?php echo u('Index/is_draw');?>",{
						data:{activity_id : activity_id},
						success : function (draw_surplus_num) {
							if (draw_surplus_num > 0) {
								get_code_number();
							}
						}
					})
				}
			}
		});
		$(".mask_layer").hide();
		$(".cite").hide();
	});
</script>
<div class="main">
	<div class="body">
		<div class="ongoing">
			<p class="date_period" id="date_end"></p>
			<div class="content">
				<div class="shop_content">
					<div class="shop">
						<img class="shop_image" src="<?php echo ($activity_data["images"]); ?>">
						<span class="sign"></span>
					</div>
					<div class="shop_title">
						<p class="desc"><span class="amount">第<?php echo ($activity_data["id"]); ?>期</span><span class="title_detail"><?php echo ($activity_data["product_name"]); ?></span></p>
						<p class="price" id="price">市场价:<span>￥<?php echo ($activity_data["market_price"]); ?></span></p>
						<p class="price" id="date">开奖时间：<span><?php echo date('Y-m-d H:i:s',$activity_data['winning_time']);?></span></p>
						<p class="price" id="finished_amount"><span ><?php echo ($activity_data["players_num"]); ?></span>人已参与</p>
					</div>
				</div>
			</div>
			<?php if($activity_data["winning_time"] < $now_time): if($activity_data["winning_code"] == '' ): ?><div class="result">
						<p class="prompt">活动已结束，一起等待开奖吧</p>
					</div>
					<?php else: ?>
					<!-- 活动已结束的-->
					<div class="result">
						<p class="prompt">活动已结束，中奖号码为</p>
						<p class="code"><?php echo ($activity_data["winning_code"]); ?></p>
						<p class="lucky">中奖幸运用户:<span><?php echo ($nickname['nickname']); ?></span></p>
						<p class="notify">*5个工作日内会有工作人员联系中奖用户，请保持通讯畅通！</p>
					</div><?php endif; ?>

				<!-- 等待开奖中-->
				<?php elseif(($activity_data["winning_time"] > $now_time) and ($activity_data["end_time"] < $now_time)): ?>
				<div class="result">
					<p class="prompt">活动已结束，一起等待开奖吧</p>
				</div>
				<!-- 明日预告-->
				<?php elseif($activity_data["start_time"] > $now_time): ?>
				<div class="upcoming">
					<span><?php echo date('Y-m-d H:i:s',$activity_data['start_time']);?>准时开始</span>
				</div>
				<?php elseif(($activity_data["end_time"] > $now_time) and ($activity_data["start_time"] < $now_time)): ?>

				<!-- 正在进行中的-->
				<div class="operate">
					<a id="<?php echo ($activity_data["id"]); ?>" class="participate" title="立即0元抽">立即0元抽</a>
					<a activity_id="<?php echo ($activity_data["id"]); ?>" class="share" title="分享给好友">分享给好友</a>
				</div><?php endif; ?>
			<?php if($record_draw != null): ?><div class="participation_code">
					<p class="tips">我的抽奖号码:</p>
					<?php if(is_array($record_draw)): $i = 0; $__LIST__ = $record_draw;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><span><?php echo ($vo); ?></span><?php endforeach; endif; else: echo "" ;endif; ?>
				</div><?php endif; ?>

			<hr style="border: dashed 1px darkgray">
			<!-- 游戏规则-->
			<div class="rules" id="rules">
				<h5 class="title">活动须知</h5>
				<div class="content_description">
					<p>活动时间：<span class="date"><?php echo date('Y-m-d H:i:s',$activity_data['start_time']);?>至<?php echo date('Y-m-d H:i:s',$activity_data['end_time']);?></span></p>
					<p>开奖及中奖公布时间：<span><?php echo date('Y-m-d H:i:s',$activity_data['winning_time']);?></span></p>
					<p>中奖公布页面：龙有宝当期的“0元抽”活动页面中。</p>
				</div>
				<h5 class="title">活动参与</h5>
				<div class="content_description">
					<p>用户通过登录龙有宝，进入“0元抽”活动页面，点击“立即0元抽”，即可活动一个抽奖码，凭此号码参与活动；</p>
				</div>
				<h5 class="title">活动细则</h5>
				<div class="content_description">
					<p>1.同一用户每天仅可领取1次抽奖码，用户通过分享本活动后将额外获得1个抽奖码。<p>
					<p>2.本活动将于开奖及中奖公布时间内抽取1位幸运中奖者并公布在中奖公布页面；<p>
					<p>3.主办方将在开奖后5个工作日内通过中奖用户绑定的手机号码通知中奖用户，用户需保证其手机号码真实有效，若开奖10个工作日后，主办方仍无法联系到中奖用户的，视为中奖用户主动放弃本奖品。<p>
					<p>4.奖品发放：主办方与中奖用户取得联系后，将核实用户收货地址等信息，并通过快递方式发放奖品；<p>
					<p>5.活动过程中，如用户出现违规行为（包括但不限于作弊、扰乱系统、实施网络攻击），龙有宝将取消违规用户的中奖资格，并有权终止其参与活动，收回中奖奖品；<p>
					<p>6.活动期间，如出现不可抗力或情势变更的情况（包括但不限于重大灾害事件、活动受政府机关指令需要停止举办或调整的、活动遭受严重网络攻击或因系统故障需要暂停举办等），龙有宝可依相关法律法规的规定主张免责。<p>
					<p>7.龙有宝可以根据本活动的实际举办情况对活动规则进行变动或调整，相关变动或调整将公布在活动页面上，公布后依法生效。<p>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<div class="mask_layer"></div>
<div class="cite"></div>
<div class="cui-tabs">
	<ul>
		<li>
			<a href="http://www.loyoubao.com">
				<p class="cui-icon">&#xe608;</p >
				<span>首页</span>
			</a>
		</li>
		<li>
			<a href="/lyg/" class="active">
				<p class="cui-icon">&#xe609;</p >
				<span>0元抽</span>
			</a>
		</li>
		<li>
			<a href="javascript:;">
				<p class="cui-icon">&#xe60a;</p >
				<span>商城</span>
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
</html>
<script type="text/javascript">
	function get_code_number(){
		$(".participate").removeClass("silent");
		$(".participate").addClass("act");
		$(".participate").bind('click',function(){
			$(".participate").removeClass("act");
			$(".participate").addClass("silent");
			$(this).unbind();
			var activity_id = $(this).attr('id');
			$.ajax("<?php echo u('Index/get_now_code');?>",{
				data:{activity_id : activity_id},
				success : function(data){
					if (data["status"] == true) {
						location.reload();
					}else if (data["has_phone"] == 1) {
						CarrotUI.confirm("是否绑定手机", function(){
							window.open("http://sso.loyoubao.com/users/bind_cellphone.html", '_self');
						});
					} else {
					}
				}
			});
		});
	}
		if("<?php echo ($draw_surplus_num); ?>" > 0 || "<?php echo ($draw_surplus_num); ?>" == ""){
			get_code_number();
		}else{
			$(".participate").removeClass("act");
			$(".participate").addClass("silent");
		}
	//分享
	$(".share").on("click",function(){
		$(".mask_layer").show();
		$("html").attr("style","overflow-y:hidden");
		var userAgent = navigator.userAgent.toLowerCase();
		if(userAgent.match(/MicroMessenger/i) == "micromessenger") {
			$(".cite").show();
			$.ajax({
				url: "http://sso.loyoubao.cn/wechat/jsapi_config",
				dataType: 'jsonp',
				data: {url: window.location.href},
				success: function(data) {
					if (data['result']) {
					}
				},

			});
		}else{
			setTimeout(function(){
				$(".mask_layer").fadeOut(200,function(){
					$(this).hide();
				});
				$("html").attr("style","overflow-y:auto");
			},2000);
			CarrotUI.tips("请使用微信浏览器访问。");
		}

	});
	$(".cite").on('click',function(){
		$(this).hide();
		$(".mask_layer").hide();
		$("html").attr("style","overflow-y:auto");
	});

	$(".mask_layer").on('click',function(){
		$(this).hide();
		$(".cite").hide();
		var timer =window.setTimeout(setDisplay,500);
		function setDisplay(){
			$(".disappear").attr("style","display:none");
			$("html").attr("style","overflow-y:auto");
			clearTimeout(timer);
		}
	});
	//计时器，倒计时
	var sign  = "";
	if ("<?php echo ($activity_data["winning_time"]); ?>" < "<?php echo ($now_time); ?>"){
		$("#date_end").html("该商品活动已结束");
	} else if("<?php echo ($activity_data["start_time"]); ?>" > "<?php echo ($now_time); ?>"){
		sign ="活动开始";
		$("date_end").countDown({
			sign:sign,
			txt_id:"date_end",
			date_time:"<?php echo ($activity_data["start_time"]); ?>"
		});
	} else if("<?php echo ($activity_data["winning_time"]); ?>" > "<?php echo ($now_time); ?>" && "<?php echo ($activity_data["end_time"]); ?>" < "<?php echo ($now_time); ?>"){
		sign = "开奖";
		$("date_end").countDown({
			sign:sign,
			txt_id:"date_end",
			id : "<?php echo ($activity_data["id"]); ?>",
			url : "<?php echo U('Index/draw_status');?>",
			date_time:"<?php echo ($activity_data["winning_time"]); ?>"
		});
	} else if("<?php echo ($activity_data["end_time"]); ?>" > "<?php echo ($now_time); ?>" && "<?php echo ($activity_data["start_time"]); ?>" < "<?php echo ($now_time); ?>"){
		sign = "活动结束";
		$("date_end").countDown({
			sign:sign,
			txt_id:"date_end",
			date_time:"<?php echo ($activity_data["end_time"]); ?>"
		});
	}
</script>