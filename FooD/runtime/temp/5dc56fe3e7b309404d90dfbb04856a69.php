<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:72:"D:\PHP\wamp64\www\FooD\public/../application/index\view\index\index.html";i:1621963256;}*/ ?>
<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

	<title>首页</title>

	<link href="/static/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css" />
	<link href="/static/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css" />

	<link href="/static/basic/css/demo.css" rel="stylesheet" type="text/css" />

	<link href="/static/css/hmstyle.css" rel="stylesheet" type="text/css"/>
	<link href="/static/css/skin.css" rel="stylesheet" type="text/css" />
	<script src="/static/AmazeUI-2.4.2/assets/js/jquery.min.js"></script>
	<script src="/static/AmazeUI-2.4.2/assets/js/amazeui.min.js"></script>

</head>

<body>
<div class="hmtop">
	<!--顶部导航条 -->
	<div class="am-container header">
		<ul class="message-l">
			<div class="topMessage">
				<div class="menu-hd">
					<?php if(empty(\think\Session::get('id'))): ?>
					<a href="<?php echo url('index/user/login'); ?>" target="_top" class="h">亲，请<span style="color: red"> 登录 </span></a>
					<a href="<?php echo url('index/user/register'); ?>" target="_top">免费<span style="color: red"> 注册 </span></a>
					<?php elseif(!empty(\think\Session::get('id'))): ?>
					尊敬的会员：<span style="color: red"> <?php echo \think\Session::get('username'); ?> </span>
					<a href="<?php echo url('index/user/loginout'); ?>"><span style="padding-left: 10px">退出</span></a>
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
					<span>购物车 <?php echo $sumcar; ?></span></a></div>
			</div>
			<div class="topMessage favorite">
				<div class="menu-hd"><a href="<?php echo url('index/person/collection'); ?>" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a></div>
		</div></ul>
	</div>

	<!--悬浮搜索框-->

	<div class="nav white">
		<div class="logo"><img src="/static/images/FooD.png" /></div>
		<div class="logoBig">
			<li><a href="<?php echo url('index/index/index'); ?>"><img style="height: 100px;width: 100px" src="/static/images/FooD.png" /></a></li>
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
<div class="banner">
	<!--轮播 -->
	<div class="am-slider am-slider-default scoll" data-am-flexslider id="demo-slider-0">
		<ul class="am-slides">
			<li class="banner1"><a><img src="/static/images/lunbo1.png" /></a></li>
			<li class="banner2"><a><img src="/static/images/lunbo2.png" /></a></li>
			<li class="banner3"><a><img src="/static/images/lunbo3.png" /></a></li>
			<li class="banner4"><a><img src="/static/images/luobo4.png" /></a></li>

		</ul>
	</div>
	<div class="clear"></div>
</div>
<div class="shopNav">
	<div class="slideall">

		<div class="long-title"><span class="all-goods">全部分类</span></div>
		<div class="nav-cont">
			<ul>
				<li class="index"><a href="/">首页</a></li>

			</ul>
		</div>

		<!--侧边导航 -->
					<div id="nav" class="navfull">
						<div class="area clearfix">
							<div class="category-content" id="guide_2">

								<div class="category">
									<ul class="category-list" id="js_climit_li">
										<?php if(is_array($one) || $one instanceof \think\Collection || $one instanceof \think\Paginator): $i = 0; $__LIST__ = $one;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>

										<li class="appliance js_toggle relative first">
											<div class="category-info">
												<h3 class="category-name b-category-name"><i><img src="/static/images/cake.png"></i><a class="ml-22" title="点心"><?php echo $value['name']; ?></a></h3>
												<em>&gt;</em></div>
											<div class="menu-item menu-in top">
												<div class="area-in">
													<div class="area-bg">
														<div class="menu-srot" style="display: flex; flex-wrap: wrap">


															<?php $child_shop = empty($value['merchant_list']); if($child_shop == false): if(is_array($shop) || $shop instanceof \think\Collection || $shop instanceof \think\Paginator): $i = 0; $__LIST__ = $shop;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$shop_item): $mod = ($i % 2 );++$i;if($value['classify_id'] == $shop_item['class_id']): ?>
																	<div class="shop_item" style="display: block; padding: .25em .5em; margin: .25em; border: 1px solid #a8a8a8">
																		<a title="<?php echo $shop_item['name']; ?>" href="<?php echo url('index/merchant/index'); ?>?id=<?php echo $shop_item['id']; ?>" style="">
																			<span><?php echo $shop_item['name']; ?></span>
																		</a>
																	</div>
																	<?php endif; endforeach; endif; else: echo "" ;endif; endif; ?>

														</div>
													</div>
												</div>
												<b class="arrow"></b>
											</div>
										</li>
										<?php endforeach; endif; else: echo "" ;endif; ?>
									</ul>
								</div>
							</div>

						</div>
					</div>


					<!--轮播-->

					<script type="text/javascript">
						(function() {
							$('.am-slider').flexslider();
						});
						$(document).ready(function() {
							$("li").hover(function() {
								$(".category-content .category-list li.first .menu-in").css("display", "none");
								$(".category-content .category-list li.first").removeClass("hover");
								$(this).addClass("hover");
								$(this).children("div.menu-in").css("display", "block")
							}, function() {
								$(this).removeClass("hover")
								$(this).children("div.menu-in").css("display", "none")
							});
						})
					</script>



				<!--小导航 -->


				<!--走马灯 -->

				<div class="marqueen">
					<span class="marqueen-title">平台头条</span>
					<div class="demo">

						<ul>


					<div class="mod-vip">
						<div class="m-baseinfo">
							<a href="">

								<?php if(!(empty(\think\Session::get('username')) || ((\think\Session::get('username') instanceof \think\Collection || \think\Session::get('username') instanceof \think\Paginator ) && \think\Session::get('username')->isEmpty()))): ?>

								<img src="<?php echo $userInfo['0']['head_pic']; ?>">
								<?php endif; if(empty(\think\Session::get('username')) || ((\think\Session::get('username') instanceof \think\Collection || \think\Session::get('username') instanceof \think\Paginator ) && \think\Session::get('username')->isEmpty())): ?>
								<img src="/static/images/getAvatar.do.jpg">
								<?php endif; ?>

							</a>
							<em>


								<a href="#"><p  style="font-size: 14px;">
									<?php if(!(empty(\think\Session::get('username')) || ((\think\Session::get('username') instanceof \think\Collection || \think\Session::get('username') instanceof \think\Paginator ) && \think\Session::get('username')->isEmpty()))): ?>

									亲爱的，<?php echo \think\Session::get('username'); ?>会员
									<?php endif; if(empty(\think\Session::get('username')) || ((\think\Session::get('username') instanceof \think\Collection || \think\Session::get('username') instanceof \think\Paginator ) && \think\Session::get('username')->isEmpty())): ?>
									Hi,你好

									<?php endif; ?>

								</p></a>
							</em>
						</div>
						<div class="member-logout">
							<?php if(empty(\think\Session::get('id'))): ?>
							<a class="am-btn-warning btn" href="<?php echo url('index/user/login'); ?>">登录</a>
							<a class="am-btn-warning btn" href="<?php echo url('index/user/mobile_register'); ?>">注册</a>
							<?php endif; ?>
						</div>
						<div class="member-login">
							<a href="#"><strong>0</strong>待收货</a>
							<a href="#"><strong>0</strong>待发货</a>
							<a href="#"><strong>0</strong>待付款</a>
							<a href="#"><strong>0</strong>待评价</a>
						</div>
						<div class="clear"></div>
					</div>
							<?php if(is_array($hot) || $hot instanceof \think\Collection || $hot instanceof \think\Paginator): $i = 0; $__LIST__ = $hot;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
							<li><a target="_blank" href="<?php echo url('index/article/blog'); ?>?id=<?php echo $value['article_id']; ?>">
								<?php if($value['allowcomments']==1): ?>
								<span>【公告】</span>
								<?php elseif($value['allowcomments']==0): ?>
								<span>【特惠】</span>
								<?php endif; ?>
								<?php echo $value['title']; ?></a></li>

							<?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>
					<div class="advTip"><img src="/static/images/advTip.jpg"/></div>
					</div>
				</div>
				<div class="clear"></div>
			</div>
			<script type="text/javascript">
				if ($(window).width() &lt; 640) {
					function autoScroll(obj) {
						$(obj).find("ul").animate({
							marginTop: "-39px"
						}, 500, function() {
							$(this).css({
								marginTop: "0px"
							}).find("li:first").appendTo(this);
						})
					}
					$(function() {
						setInterval('autoScroll(".demo")', 3000);
					})
				}
			</script>
		</div>
		<div class="shopMainbg">
			<div class="shopMain" id="shopmain">

				<!--今日推荐 -->

				<div class="am-g am-g-fixed recommendation">
					<div class="clock am-u-sm-3" >

						<p>今日<br>推荐</p>
					</div>

				<?php if(is_array($goods) || $goods instanceof \think\Collection || $goods instanceof \think\Paginator): $i = 0; $__LIST__ = $goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
					<div class="am-u-sm-4 am-u-lg-3 ">
						<div class="info " style="width: 150px;height: 80px;overflow: hidden;">
							<h3>精选餐</h3>
							<p><?php echo $value['good_name']; ?></p>

						</div>
						<div class="recommendationMain one">
							<a href="<?php echo url('index/goods/introduction'); ?>?id=<?php echo $value['goods_id']; ?>"><img src="<?php echo $value['imgpath']; ?>"></a>
						</div>
					</div>
				<?php endforeach; endif; else: echo "" ;endif; ?>


				</div>
				<div class="clear "></div>
				<!--热门活动 -->

				<div class="am-container activity ">
					<div class="shopTitle ">
						<h4>商家列表</h4>
						<h3>每期活动 优惠享不停 </h3>
						<span class="more ">
						  <a href="<?php echo url('index/merchant/shops'); ?>">全部商家<i class="am-icon-angle-right" style="padding-left:10px ;" ></i></a>
					</span>
					</div>

				  <div class="am-g am-g-fixed ">
					  <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
					  <a href="/index/merchant/index?id=<?php echo $v['id']; ?>">
					  <div class="am-u-sm-3" style="float: left">
						  <div class="icon-sale one "></div>
						  <h4><?php echo $v['class_name']; ?></h4>
						  <div class="activityMain ">
							  <img src="<?php echo $v['logo']; ?>" width="296" height="314">
						  </div>

						  <?php if(!empty($v['introduce'])): ?>
						  <div class="info ">
							  <h3>
								  <?php echo $v['introduce']; ?>
							  </h3>
						  </div>
						  <?php else: ?>
						  <div class="info ">
							  <h3>
								  商家暂无填写
							  </h3>
						  </div>
						  <?php endif; ?>

					  </div>
					  </a>
					  <?php endforeach; endif; else: echo "" ;endif; ?>
				  </div>
			   </div>
				<div class="clear "></div>
	</div>
			</div>
</body>
</html>