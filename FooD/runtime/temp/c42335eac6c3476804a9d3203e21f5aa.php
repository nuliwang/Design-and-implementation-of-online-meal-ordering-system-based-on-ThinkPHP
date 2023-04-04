<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:78:"D:\PHP\wamp64\www\FooD\public/../application/index\view\person\collection.html";i:1620806097;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">
	<title>我的收藏</title>
	<link href="/static/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
	<link href="/static/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">
	<link href="/static/css/personal.css" rel="stylesheet" type="text/css">
	<link href="/static/css/colstyle.css" rel="stylesheet" type="text/css">
	<style>

	</style>
</head>

	<body>
		<!--头 -->
		<header>
			<article>
				<div class="mt-logo">
					<!--顶部导航条 -->
					<div class="am-container header">
						<ul class="message-l">
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
						</ul>
						<ul class="message-r">
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
						</ul>
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
				</div>
			</article>
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

					<div class="user-collection">
						<!--标题 -->
						<div class="am-cf am-padding">
							<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">我的收藏</strong> / <small>My&nbsp;Collection</small></div>
						</div>
						<hr/>

						<div class="you-like">
							<div class="s-bar">
								我的收藏
								<a class="am-badge am-badge-danger am-round">降价</a>
								<a class="am-badge am-badge-danger am-round">下架</a>
							</div>
							<div class="s-content">


								<?php if(is_array($collect) || $collect instanceof \think\Collection || $collect instanceof \think\Paginator): $i = 0; $__LIST__ = $collect;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>



								<div class="s-item-wrap">
									<div class="s-item">

										<div class="s-pic">
											<a href="<?php echo url('index/goods/introduction'); ?>?id=<?php echo $value['goods_id']; ?>" class="s-pic-link">
												<img src="<?php echo $value['imgpath']; ?>" alt="<?php echo $value['good_name']; ?>" title="<?php echo $value['good_name']; ?>" class="s-pic-img s-guess-item-img">
											</a>
										</div>
										<div class="s-info" style="position: relative;">
											<div class="s-title"><a href="#" title="<?php echo $value['good_name']; ?>">【<?php echo $value['good_name']; ?>】</a></div>
											<div class="s-price-box">
												<span class="s-price"><em class="s-price-sign">¥</em><em class="s-value"><?php echo $value['price']; ?></em></span>
												<span class="s-history-price"><em class="s-price-sign">¥</em><em class="s-value"><?php echo $value['market']; ?></em></span>
											</div>
											<div class="s-extra-box">
												<span class="s-comment">评价: <?php echo $value['comment_count']; ?></span>
												<span class="s-sales">销量: <?php echo $value['sales_count']; ?></span>
											</div>
											<div class="s-extra-box">
												<span class="s-comment">收藏时间:
													<?php echo date("Y-m-d",$value['add_time']); ?>
													</span>

											</div>
										</div>
										<div class="s-tp" >
											<a href="<?php echo url('index/goods/delCollection'); ?>?id=<?php echo $value['collect_id']; ?>">
												<span class="ui-btn-loading-before">取消收藏</span>
											</a>
											<a href="<?php echo url('index/goods/addcar'); ?>?id=<?php echo $value['goods_id']; ?>">
												<span class="ui-btn-loading-before buy">加入购物车</span>
											</a>

										</div>
									</div>
								</div>


										<?php endforeach; endif; else: echo "" ;endif; ?>
















							</div>

							<div class="s-more-btn i-load-more-item" data-screen="0"><i class="am-icon-refresh am-icon-fw"></i>更多</div>

						</div>

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

	</body>

</html>