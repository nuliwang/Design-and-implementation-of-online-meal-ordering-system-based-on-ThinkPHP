<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"D:\PHP\wamp64\www\FooD\public/../application/index\view\person\commentlist.html";i:1620806098;}*/ ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">

	<title>发表评论</title>

	<link href="/static/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
	<link href="/static/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">

	<link href="/static/css/personal.css" rel="stylesheet" type="text/css">
	<link href="/static/css/appstyle.css" rel="stylesheet" type="text/css">

	<style>
		.comment-main * {float: unset !important}
		.comment-main .comment-list {display: flex}
		.comment-main .comment-content {position: relative;flex: 1}
		.comment-main .comment-content .item-opinion {display: flex}
		.comment-main .goods-info {position: relative}

	</style>
</head>
<body>

<!--头 -->
<header>
	<div class="mt-logo">
		<!--顶部导航条 -->
		<div class="am-container header">
			<div class="message-l">
				<div class="topMessage">
					<div class="menu-hd">
						<?php if(empty(\think\Session::get('id'))): ?>
						<a href="<?php echo url('index/user/login'); ?>" target="_top" class="h">亲，请<span style="color: red"> 登录 </span></a>
						<a href="#" target="_top">免费<span style="color: red"> 注册 </span></a>
						<?php elseif(!empty(\think\Session::get('id'))): ?>
						尊敬的会员：<span style="color: red"> <?php echo \think\Session::get('username'); ?> </span>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<div class="message-r">
				<div class="topMessage home">
					<div class="menu-hd"><a href="<?php echo url('index/index/index'); ?>" target="_top" class="h">FooD点餐首页</a></div>
				</div>
				<div class="topMessage my-shangcheng">
					<div class="menu-hd MyShangcheng"><a href="<?php echo url('index/person/center'); ?>" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a></div>
				</div>
				<div class="topMessage mini-cart">
					<div class="menu-hd"><a id="mc-menu-hd" href="<?php echo url('index/goods/shopcar'); ?>" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i>
						<span>购物车</span><strong id="J_MiniCartNum" class="h"><?php echo $sumcar; ?></strong></a></div>
				</div>
				<div class="topMessage favorite">
					<div class="menu-hd"><a href="<?php echo url('index/person/collection'); ?>" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a></div>
				</div>
			</div>
		</div>

		<!--悬浮搜索框-->
		<div class="nav white">
			<div class="logoBig">
				<li><img style="height: 100px;width: 100px" src="/static/images/FooD.png" /></li>
			</div>

			<div class="search-bar pr">
				<a name="index_none_header_sysc" href="#"></a>
				<form action="<?php echo url('index/search/searchs'); ?>" method="post">
					<input id="searchInput" name="keys" type="text" placeholder="搜索"  autocomplete="off">
					<input id="ai-topsearch" class="submit am-btn" value="搜索" index="1" type="submit">
				</form>
			</div>
		</div>

		<div class="clear"></div>
	</div>
</header>

<div class="nav-table">
   <div class="long-title"><span class="all-goods">全部分类</span></div>
   <div class="nav-cont">
		<ul>
			<li class="index"><a href="/">首页</a></li>
		</ul>
	</div>
</div>

<b class="line"></b>

<div class="center">
	<div class="col-main">
		<div class="main-wrap">

				<div class="user-comment">
					<!--标题 -->
					<div class="am-cf am-padding">
						<div class="am-fl am-cf">
							<strong class="am-text-danger am-text-lg">发表评论</strong> / <small>Make&nbsp;Comments</small>
						</div>
					</div>

					<hr/>

					<?php if(is_array($goods_info) || $goods_info instanceof \think\Collection || $goods_info instanceof \think\Paginator): $i = 0; $__LIST__ = $goods_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>

					<form action="<?php echo url('index/person/saygoods'); ?>" method="post" enctype="multipart/form-data">

					<?php
					$gid = $vo['goods_id'];
					$cur_comment_exist=empty($comment_list[$gid]) ? 0 : 1; ?>

					<div class="comment-main">
						<div class="comment-list">
							<div class="goods-info">
								<input type="hidden" name="goodsid" value="<?php echo $gid; ?>"/>
								<div class="item-pic" style="min-height: 150px;min-width: 150px">
									<a href="#" class="J_MakePoint">
										<img src="<?php echo $vo['imgpath']; ?>" class="itempic">
									</a>
								</div>
								<div class="item-title">
									<div class="item-name">
										<a href="#">
											<p class="item-basic-info">【<?php echo $vo['good_name']; ?>】</p>
										</a>
									</div>
									<div class="item-info">
										<div class="item-price">
											价格：<strong><?php echo $vo['price']; ?>元</strong>
										</div>
									</div>
								</div>
							</div>
							<div class="comment-content">
								<div class="item-opinion" style="position: unset;width: auto;max-width: unset">
									<?php if($cur_comment_exist == 0): ?>
									<li>
										<label for="radio-<?php echo $key; ?>-good">
											<input type="radio" name="fell" id="radio-<?php echo $key; ?>-good" checked value="1">
											好评
										</label>
										<i class="op1" ></i>
									</li>
									<li>
										<label for="radio-<?php echo $key; ?>-normal">
											<input type="radio" name="fell" id="radio-<?php echo $key; ?>-normal" value="2">
											中评
										</label>
										<i class="op2"></i>
									</li>
									<li>
										<label for="radio-<?php echo $key; ?>-bad">
											<input type="radio" name="fell" id="radio-<?php echo $key; ?>-bad" value="3">
											差评
										</label>
										<i class="op3"></i>
									</li>
									<?php else: ?>
										<li style="text-align: left;text-indent: 2em">
											<span>我的评价：</span>
											<label>
											
												<?php $curr_good = $comment_list[$gid]; switch($curr_good['goods_rand']): case "1": ?>好评<?php break; case "2": ?>中评<?php break; case "3": ?>差评<?php break; default: ?>无
												<?php endswitch; ?>
											</label>
											<i class="op<?php echo $comment_list[$gid]['goods_rand']; ?> active"></i>
										</li>
									<?php endif; ?>
								</div>
								<div class="item-comment" style="position: unset;width: auto;max-width: unset">
									<?php if($cur_comment_exist == 0): ?>
									<textarea placeholder="请写下对宝贝的感受吧，对他人帮助很大哦！" name="content"></textarea>
									<?php else: ?>
									<textarea disabled><?php echo $comment_list[$gid]['content']; ?></textarea>
									<?php endif; ?>
								</div>
								<div class="filePic" style="position: unset;top:-120px ;width: auto;z-index: 999">
									<span style="color: tomato;cursor: default">评价晒图</span><br>
									<?php if($cur_comment_exist == 0): ?>
									<input type="file" name="file" >
									<input type="hidden" name="images" value=""/>
									<?php else: ?>
									<img src="<?php echo $comment_list[$gid]['comment_img']; ?>" alt="" style="display: block;max-width: 375px">
									<?php endif; ?>
								</div>
							</div>
						</div>

						<?php if($cur_comment_exist == 0): ?>
						<div class="info-btn">
							<input type="hidden" name="order_sn" value="<?php echo $order_sn; ?>"/>
							<button type="button" class="am-btn am-btn-danger comment-submit">发表评论</button>
						</div>
						<?php endif; ?>
					</div>
					<hr style="margin: 1em 0 .35em">
					</form>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</div>

		</div>

		<!--底部-->
		<div class="footer">
			<div class="footer-hd">
				<p>
					<a href="#"></a>
					<b>|</b>
					<a href="#">FooD点餐首页</a>
					<b>|</b>
					<a href="#">支付宝</a>
					<b>|</b>
					<a href="#">物流</a>
				</p>
			</div>
			<div class="footer-bd">
				<p>
					<a href="#"></a>
					<a href="#">合作伙伴</a>
					<a href="#">联系我们</a>
					<a href="#">网站地图</a>
					<em>© 2020-2020 版权所有</em>
				</p>
			</div>
		</div>
	</div>
	<aside class="menu">
		<ul>
			<li class="person active">
				<a>个人中心</a>
			</li>
			<li class="person">
				<ul>
					<li> <a href="<?php echo url('index/person/information'); ?>">个人信息</a></li>
					<li> <a href="<?php echo url('index/person/password'); ?>">安全设置</a></li>
					<li> <a href="<?php echo url('index/person/address'); ?>">收货地址</a></li>
				</ul>
			</li>
			<li class="person">
				<a>我的交易</a>
				<ul>
					<li><a href="<?php echo url('index/person/order'); ?>">订单管理</a></li>
				</ul>
			</li>
			<li class="person">
				<a>我的小窝</a>
				<ul>
					<li> <a href="<?php echo url('index/person/collection'); ?>">收藏</a></li>
					<li> <a href="<?php echo url('index/person/comment'); ?>">评价</a></li>
				</ul>
			</li>
		</ul>
	</aside>
</div>

<script type="text/javascript" src="/static/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="/static/AmazeUI-2.4.2/assets/js/amazeui.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$(".comment-list .item-opinion li").click(function() {
			$(this).prevAll().children('i').removeClass("active");
			$(this).nextAll().children('i').removeClass("active");
			$(this).children('i').addClass("active");
		});

		$(".comment-submit").on('click', function(e){
			let cur_form = $(e.target).parents('form'),
				formData = new FormData()
			formData.append('file', $('input[name="file"]')[0].files[0])
			$.ajax({
				type: "POST",
				url: "<?php echo url('index/person/upload_img'); ?>",
				contentType: false,
				processData: false,
				data: formData,
				success: function (data){
					if(data.code===200){
						$('input[name="images"]').val(data.msg)
						console.log('有图')
					}
					$.ajax({
						type: "POST",
						url: "<?php echo url('index/person/saygoods'); ?>",
						dataType:'json',
						data: cur_form.serialize(),
						success: function (result){
							window.location.reload()
							alert(result.msg)
						}
					})
				}
			})
		})
	})
</script>
</body>
</html>