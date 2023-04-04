<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:75:"D:\PHP\wamp64\www\FooD\public/../application/index\view\merchant\shops.html";i:1620806097;}*/ ?>
<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

	<title>全部商家</title>

	<link href="/static/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css" />
	<link href="/static/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css" />

	<link href="/static/basic/css/demo.css" rel="stylesheet" type="text/css" />

	<link href="/static/css/seastyle.css" rel="stylesheet" type="text/css" />

	<link href="/static/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<script src="/static/AmazeUI-2.4.2/assets/js/jquery.min.js"></script>
	<script src="/static/AmazeUI-2.4.2/assets/js/amazeui.min.js"></script>
	<script type="text/javascript" src="/static/basic/js/jquery-1.7.min.js"></script>
	<script type="text/javascript" src="/static/js/script.js"></script>
	<style>
		.activity .icon-sale {
			position: absolute;
			width: 0;
			height: 0;
			border-top: 40px solid #0087e5;
			border-right: 40px solid transparent;
		}

		.activity .icon-sale.one {
			border-top-color: #9b0d5f;
		}
		.activity a div h4 {
			position: absolute;
			color: #fff;
			top: 5px;
			left: 2px;
		}
		.activity .info {margin-top: 5px;}
		.activity .info h3 {margin: 0}

		@media only screen and (min-width: 640px) {

			.activity .icon-sale {
				border-top: 60px solid #0087e5;
				border-right: 60px solid transparent;
			}
			.activity a div h4 {
				position: absolute;
				color: #fff;
				top: 10px;
				left: 5px;
			}
			.activity .info {
				text-align: center;
				position: absolute;
				left: 5%;
				width: 90%;
				bottom: 5px;
				background: #eee;
				padding: 5px;
			}
		}
		@media only screen and (min-width: 1025px){
			.activity .icon-sale {
				border-top: 100px solid #0087e5;
				border-right: 100px solid transparent;
			}
			.activity a div h4 {
				position: absolute;
				color: #fff;
				top: 10px;
				left: 10px;
				font-size: 16px;
			}
			.activity .info {
				font-size: 16px;
				bottom: 10px;
			}
		}
	</style>
</head>
<body>

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
	<div class="logo"><img src="/static/images/FooD.png" /></div>
	<div class="logoBig">
		<li><img style="height: 100px;width: 100px" src="/static/images/FooD.png" /></li>
	</div>
	<div class="search-bar pr" style="width: 1200px;height: 90px;">
		<a name="index_none_header_sysc" href="javascript:;"></a>
		<form action="<?php echo url('index/merchant/searchs'); ?>" method="post">
			<input id="searchInput" name="keys" type="text" placeholder="请输入你要搜索的店铺"  autocomplete="off">
			<input id="ai-topsearch" class="submit am-btn" value="搜索" index="1" type="submit" style="display: block;height:47px;width: 150px; position: absolute;top: 21px;left: 750px;">
		</form>
	</div>
</div>

<div class="clear"></div>
<b class="line"></b>
<div class="search">
	<div class="search-list">
		<div class="nav-table">
			<div class="long-title"><span class="all-goods">全部分类</span></div>
			<div class="nav-cont">
				<ul>
					<li><a href="/">首页</a></li>
				</ul>
			</div>
		</div>

		<div class="am-g am-g-fixed" style="padding-bottom: 2em">
			<div class="am-u-sm-12 am-u-md-12" style="float: unset !important;">
				<div class="theme-popover">
					<div class="searchAbout">
								<span class="font-pale">全部商家</span>
					</div>
					<ul class="select">
						<p class="title font-normal" style="margin: 0">
							<b>
								<span class="total fl" style="font-size: 18px;padding-left: 20px;">
								共有<strong class="num" style="font-size: 20px;color: red;"><?php echo $shops_count; ?></strong>个商家
								</span>
							</b>
						</p>
						<div class="clear"></div>
						<li class="select-result">
							<dl>
								<dt>已选</dt>
								<dd class="select-no"></dd>
								<p class="eliminateCriteria">清除</p>
							</dl>
						</li>
					</ul>
					<div class="clear"></div>
				</div>
				<div class="search-content" style="width: 100%">
					<div class="sort <?php echo $sort; ?>">
						<li class="<?php echo $sort=='default'?'first':''; ?>"><a title="综合" href="<?php echo url('index/merchant/shops'); ?>">综合排序</a></li>
						<li class="<?php echo $sort=='comment'?'first':''; ?>"><a title="评价" href="<?php echo url('index/merchant/shops'); ?>?sort=comment">好评排序</a></li>
						<li class="<?php echo $sort=='sales'?'first':''; ?>"><a title="销量" href="<?php echo url('index/merchant/shops'); ?>?sort=sales">销量排序</a></li>
					</div>
					<div class="clear"></div>
						<ul class="merchant_list activity boxes" style="display: flex;flex-wrap: wrap">
							<?php if(is_array($shops) || $shops instanceof \think\Collection || $shops instanceof \think\Paginator): $i = 0; $__LIST__ = $shops;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
							<li style="flex: 20%;max-width: 20%">
								<a href="/index/merchant/index?id=<?php echo $value['id']; ?>" style="display: block">
									<div class="am-u-sm-3" style="width: 100%">
										<div class="icon-sale one"></div>
										<h4><?php echo $value['class_name']; ?></h4>
										<div class="activityMain ">
											<img src="<?php echo $value['logo']; ?>" style="width: 240px;height: 240px">
										</div>

										<?php if(!empty($value['introduce'])): ?>
										<div class="info ">
											<span><?php echo $value['introduce']; ?></span>
										</div>
										<?php else: ?>
										<div class="info ">
											<span>商家暂无填写</span>
										</div>
										<?php endif; ?>

									</div>
								</a>
							</li>
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>
					</div>
				<div class="clear"></div>
			</div>

						<!--分页 -->
						<div style="margin: 1em auto;padding: 1em 0;width: fit-content">
							<?php echo $page; ?>
						</div>
					</div>
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

			</div>

		<!--引导 -->
		<div class="navCir">
			<li><a href="home.html"><i class="am-icon-home "></i>首页</a></li>
			<li><a href="sort.html"><i class="am-icon-list"></i>分类</a></li>
			<li><a href="shopcart.html"><i class="am-icon-shopping-basket"></i>购物车</a></li>	
			<li><a href="person/index.html"><i class="am-icon-user"></i>我的</a></li>					
		</div>

		<script>
			window.jQuery || document.write('<script src="basic/js/jquery-1.9.min.js"><\/script>');
		</script>
		<script type="text/javascript" src="basic/js/quick_links.js"></script>

<div class="theme-popover-mask"></div>


</body>

</html>