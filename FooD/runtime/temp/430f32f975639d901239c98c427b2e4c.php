<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:75:"D:\PHP\wamp64\www\FooD\public/../application/index\view\search\searchs.html";i:1620806099;s:72:"D:\PHP\wamp64\www\FooD\application\index\view\common\sidebar_search.html";i:1620806096;}*/ ?>
<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

	<title>搜索页面</title>

	<link href="/static/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css" />
	<link href="/static/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css" />

	<link href="/static/basic/css/demo.css" rel="stylesheet" type="text/css" />

	<link href="/static/css/seastyle.css" rel="stylesheet" type="text/css" />

	<link href="/static/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<script src="/static/AmazeUI-2.4.2/assets/js/jquery.min.js"></script>
	<script src="/static/AmazeUI-2.4.2/assets/js/amazeui.min.js"></script>
	<script type="text/javascript" src="/static/basic/js/jquery-1.7.min.js"></script>
	<script type="text/javascript" src="/static/js/script.js"></script>
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
				<span>购物车 </span><strong id="J_MiniCartNum" class="h"><?php echo $sumcar; ?> </strong></a></div>
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
		<a name="index_none_header_sysc" href="#"></a>
		<form action="<?php echo url('index/search/searchs'); ?>" method="post">
			<input id="searchInput" name="keys" type="text" placeholder="请输入你要搜索的商品"  autocomplete="off">
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
								<span class="font-pale">搜索关键字：
									<span style="color: red;">
									<?php if(empty($keys)): ?>
									你未输入关键字，本次为随机搜索
									<?php endif; ?>
									<?php echo $keys; ?>
									</span>
								</span>
					</div>
					<ul class="select">
						<p class="title font-normal" style="margin: 0">

							<b><span class="total fl" style="font-size: 18px;padding-left: 20px;">搜索到<strong class="num" style="font-size: 20px;color: red;"><?php echo $sumgoods; ?></strong>件相关商品</span></b>
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
				<div class="search-content">
					<div class="sort">
						<li class="first"><a title="综合" href="<?php echo url('index/search/searchs'); ?>">综合排序</a></li>
						<li><a title="销量" href="<?php echo url('index/search/sales'); ?>">销量排序</a></li>
						<li><a title="价格" href="<?php echo url('index/search/price'); ?>">价格优先</a></li>
						<li class="big"><a title="评价" href="<?php echo url('index/search/comment'); ?>">评价为主</a></li>
					</div>
					<div class="clear"></div>
						<ul class="am-avg-sm-2 am-avg-md-3 am-avg-lg-4 boxes">
							<?php if(is_array($goods) || $goods instanceof \think\Collection || $goods instanceof \think\Paginator): $i = 0; $__LIST__ = $goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
							<li>
								<div class="i-pic limit">
									<a href="<?php echo url('index/goods/introduction'); ?>?id=<?php echo $value['goods_id']; ?>"
									   style="display:block;text-decoration: none">
										<div style="display: block;width: 100%;height:180px;margin: 0 auto 3em;">
											<img src="<?php echo $value['imgpath']; ?>" />
										</div>

										<p class="title fl">【<?php echo $value['good_name']; ?>】</p>
										<p class="price fl" style="padding: .25em 1em">
											<b>¥</b>
											<strong><?php echo $value['price']; ?></strong>
										</p>
										<p class="number fl" style="padding-right: 1em">
											销量<span><?php echo $value['sales_count']; ?></span>&nbsp;
											评论<span><?php echo $value['comment_count']; ?></span>
										</p>
									</a>
								</div>
							</li>
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>
							</div>
							<div class="search-side">
								<div class="side-title">
									经典搭配
								</div>
								<ul>
									<li style="height: auto">
										<div class="i-pic check" style="margin: 8px auto 9px">
											<img src="/static/images/kl.png" />
											<p class="check-title">柠檬可乐</p>
											<p class="price fl">
												<b>¥</b>
												<strong>29.90</strong>
											</p>
											<p class="number fl">
												销量<span>1110</span>
											</p>
										</div>
									</li>
									<li style="height: auto">
										<div class="i-pic check" style="margin: 8px auto 9px">
											<img src="/static/images/ps.jpg" />
											<p class="check-title">美式海鲜披萨</p>
											<p class="price fl">
												<b>¥</b>
												<strong>8.90</strong>
											</p>
											<p class="number fl">
												销量<span>1110</span>
											</p>
										</div>
									</li>
									<li style="height: auto">
										<div class="i-pic check" style="margin: 8px auto 9px">
											<img src="/static/images/jmh.jpg" />
											<p class="check-title">鸡米花</p>
											<p class="price fl">
												<b>¥</b>
												<strong>29.90</strong>
											</p>
											<p class="number fl">
												销量<span>1110</span>
											</p>
										</div>
									</li>
								</ul>
							</div>
							<div class="clear"></div>
						</div>

						<!--分页 -->
						<div style="margin: 1em auto;padding: 1em 0;width: fit-content"><?php echo $page; ?></div>
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

		<!--菜单 -->
<style>
    /*#sidebar .sidebar_user_center:hover ~.status_login,*/
    /*#sidebar .sidebar_user_center ~.status_login:hover{display: block}*/
    .item {cursor: unset !important}
    .item .login_btnbox >a:hover {color: #ed145b}
</style>
<div class=tip>
    <div id="sidebar">
        <div id="wrap">
            <div id="prof" class="item">
                <a class="sidebar_user_center" href="<?php echo url('index/person/center'); ?>">
                    <span class="setting"></span>
                </a>
                <div class="ibar_login_box status_login">
                    <div class="avatar_box">
                        <p class="avatar_imgbox"><img src="/static/images/no-img_mid_.jpg" /></p>
                    </div>
                    <div class="login_btnbox">
                        <a href="<?php echo url('index/person/order'); ?>" class="login_order">我的订单</a>
                        <a href="<?php echo url('index/person/collection'); ?>" class="login_favorite">我的收藏</a>
                    </div>
                    <i class="icon_arrow_white"></i>
                </div>

            </div>
            <div id="shopCart" class="item" style="height: 11em">
                <a href="<?php echo url('index/goods/shopcar'); ?>" style="display: flex;flex-direction: column;height: auto;align-items: center;justify-content: center;padding: 1em 0 .5em">
                    <span class="message" style="float: unset !important;position: unset !important;"></span>
                    <p style="float: unset !important;font-size:1em;width:16px;margin:0;padding:.5em 0;writing-mode: tb;color: #ccc;letter-spacing: 5px">购物车</p>
                    <p class="cart_num" style="float: unset !important;"><?php echo $sumcar; ?></p>
                </a>
            </div>

            <div id="brand" class="item">
                <a href="<?php echo url('index/person/collection'); ?>">
                    <span class="wdsc"><img src="/static/images/wdsc.png" /></span>
                </a>
                <div class="mp_tooltip">
                    我的收藏
                    <i class="icon_arrow_right_black"></i>
                </div>
            </div>

            <div class="quick_toggle">
                <li class="qtitem">
                    <a href="#top" class="return_top"><span class="top"></span></a>
                </li>
            </div>

            <!--回到顶部 -->
            <div id="quick_links_pop" class="quick_links_pop hide"></div>

        </div>

    </div>
</div>

		<script>
			window.jQuery || document.write('<script src="basic/js/jquery-1.9.min.js"><\/script>');
		</script>
		<script type="text/javascript" src="basic/js/quick_links.js"></script>

<div class="theme-popover-mask"></div>


</body>

</html>