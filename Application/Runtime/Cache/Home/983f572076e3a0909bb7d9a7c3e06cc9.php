<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Insert title here</title>
	<!--样式-->
	<style type="text/css">
		body {margin:40px auto; width:800px; font-size:12px; color:#666;}
		.item{
			border: 1px solid #D4D4D4;
			color: red;
			margin: 0 10px 10px 0;
			padding: 10px;
			position: relative;
			width: 200px;
		}
		.loading-wrap{
			bottom: 50px;
			width: 100%;
			height: 52px;
			text-align: center;
			display: none;
		}
		.loading {
			padding: 10px 10px 10px 52px;
			height: 32px;
			line-height: 28px;
			color: #FFF;
			font-size: 20px;
			border-radius: 5px;
			background: 10px center rgba(0,0,0,.7);
		}
		.footer{
			border: 2px solid #D4D4D4;
		}
	</style>
	<!--样式-->
</head>
<body>
<!--引入所需要的jquery和插件-->
<script type="text/javascript" src="/Public/home/js/jquery-1.9.1.min.js"></script>

<!--<script type="text/javascript" src="/test/public/Js/jquery.masonry.min.js"></script>-->
<!--引入所需要的jquery和插件-->
<!--瀑布流-->
<div id="container" class=" container">
	<!--这里通过设置每个div不同的高度，来凸显布局的效果-->
	<?php if(is_array($height)): $i = 0; $__LIST__ = $height;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="item" style="height:<?php echo ($vo); ?>px;">瀑布流下来了</div>
		<input type="hidden" name="last_id" class="last_id" value="<?php echo ($vo["id"]); ?>"/><?php endforeach; endif; else: echo "" ;endif; ?>
</div>
<!--瀑布流-->
<!--加载中-->
<div id="loading" class="loading-wrap">
	<span class="loading">加载中，请稍后...</span>
</div>
<!--加载中-->
<!--尾部-->
<div class="footer"><center>我是页脚</center></div>
<!--尾部-->
<script type="text/javascript">
	//用于转换unix时间戳
	function unix_to_datetime(unix)
	{
		var now = new Date(parseInt(unix) * 1000);
		return now.toLocaleString().replace(/年|月/g, "-").replace(/日/g, " ");
	}
	$(function(){
//页面初始化时执行瀑布流
		var $container = $('#container');
		$container.masonry({
			itemSelector : '.item',
			isAnimated: true
		});
//用户拖动滚动条，达到底部时ajax加载一次数据
		var loading = $("#loading").data("on", false);//通过给loading这个div增加属性on，来判断执行一次ajax请求
		$(window).scroll(function(){
			if(loading.data("on")) return;
			if($(document).scrollTop() > $(document).height()-$(window).height()-$('.footer').height()),//传值
					function(data){
//获取到了数据data,后面用JS将数据新增到页面上
						var getdata = data.data;
						var html = "";
						if($.isArray(getdata)){
							$.each(data.data,function(i,item) {
								html += "<div class=\"item\" style=\"height:"+data[i]+"px;\">瀑布又流下来了</div>";
							});
							var $newElems = $(html).css({ opacity: 0 }).appendTo($container);
							$newElems.imagesLoaded(function(){
								$newElems.animate({ opacity: 1 });
								$container.masonry( 'appended', $newElems, true );
							});
//一次请求完成，将on设为false，可以进行下一次的请求
							loading.data("on", false);
						}
						loading.fadeOut();
					},
					"json"
				);
			}
		});
	});
</script>
</body>
</html>