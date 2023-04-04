<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:73:"D:\PHP\wamp64\www\FooD\public/../application/index\view\person\order.html";i:1620806098;}*/ ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">
	<title>订单管理</title>
	<link href="/static/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
	<link href="/static/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">
	<link href="/static/css/personal.css" rel="stylesheet" type="text/css">
	<link href="/static/css/orstyle.css" rel="stylesheet" type="text/css">
	<script src="/static/AmazeUI-2.4.2/assets/js/jquery.min.js"></script>
	<script src="/static/AmazeUI-2.4.2/assets/js/amazeui.js"></script>
	<style>.order-right{width: 37%}</style>
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
   <div class="long-title">
	   <span class="all-goods">全部分类</span>
   </div>
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

			<div class="user-order">

				<!--标题 -->
				<div class="am-cf am-padding">
					<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">订单管理</strong> / <small>Order</small></div>
				</div>

				<div class="am-tabs am-tabs-d2 am-margin" data-am-tabs>

					<ul class="am-avg-sm-5 am-tabs-nav am-nav am-nav-tabs">
						<li class="am-active"><a href="#tab1">所有订单</a></li>
					</ul>

					<div class="am-tabs-bd">
						<div class="am-tab-panel am-fade am-in am-active" id="tab1">
							<div class="order-top" style="display: flex;justify-content: space-between;">
								<div class="th th-item">
									<td class="td-inner">商品</td>
								</div>
								<div class="th th-price">
									<td class="td-inner">单价</td>
								</div>
								<div class="th th-number">
									<td class="td-inner">数量</td>
								</div>
								<div class="th th-amount">
									<td class="td-inner">合计</td>
								</div>
								<div class="th th-status">
									<td class="td-inner">交易状态</td>
								</div>
								<div class="th th-change">
									<td class="td-inner">交易操作</td>
								</div>
							</div>

							<div class="order-main">
								<div class="order-list">
									<?php if(is_array($order) || $order instanceof \think\Collection || $order instanceof \think\Paginator): $i = 0; $__LIST__ = $order;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;
										$cur_good_info = $goods_info[$value['goods_list'][0][0]];
										$cur_good_num = $value['goods_list'][1][0];
									?>
									<!--交易成功-->
									<div class="order-status5">
										<div class="order-title">
											<div class="dd-num">订单编号：<a href="/index/orders/successs?ordernum=<?php echo $value['order_sn']; ?>"><?php echo $value['order_sn']; ?></a></div>
											<span>成交时间：<?php echo date("Y-m-d H:i:s",$value['add_time']); ?></span>
										</div>
										<div class="order-content">
											<div class="order-left">
												<ul class="item-list" style="text-align: center">
													<li class="td td-item">
														<div class="item-pic">
															<a href="<?php echo $value['is_multi'] == 1 ? '#' : url('index/goods/introduction').'?id='.$value['goods_id']; ?>" class="J_MakePoint">
																<?php if((empty($cur_good_info['imgpath']))): ?>
																商品已下架
																<?php else: ?>
																<img src="<?php echo $cur_good_info['imgpath']; ?>" class="itempic J_ItemImg">
																<?php endif; ?>
															</a>
														</div>
														<div class="item-info">
															<div class="item-basic-info">
																<?php if(is_array($value['goods_list'][0]) || $value['goods_list'][0] instanceof \think\Collection || $value['goods_list'][0] instanceof \think\Paginator): $num = 0; $__LIST__ = $value['goods_list'][0];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$id): $mod = ($num % 2 );++$num;?>
																<a href="<?php echo url('index/goods/introduction'); ?>?id=<?php echo $id; ?>">
																	<p>
																		<?php echo $goods_info[$id]['good_name']; ?>
																	</p>
																</a>
																<?php endforeach; endif; else: echo "" ;endif; ?>
															</div>
														</div>
													</li>
													<li class="td td-price">
														<div class="item-price" style="color: red;">
															<?php if(is_array($value['goods_list'][0]) || $value['goods_list'][0] instanceof \think\Collection || $value['goods_list'][0] instanceof \think\Paginator): $k = 0; $__LIST__ = $value['goods_list'][0];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$id): $mod = ($k % 2 );++$k;?>
															<div><?php echo $goods_info[$id]['price']; ?></div>
															<?php endforeach; endif; else: echo "" ;endif; ?>
														</div>
													</li>
													<li class="td td-number" style="width: 10%">
														<div class="item-number">
															<?php if(is_array($value['goods_list'][0]) || $value['goods_list'][0] instanceof \think\Collection || $value['goods_list'][0] instanceof \think\Paginator): $k = 0; $__LIST__ = $value['goods_list'][0];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$id): $mod = ($k % 2 );++$k;?>
																<div><span>×</span><?php echo $value['goods_list'][1][$k-1]; ?></div>
															<?php endforeach; endif; else: echo "" ;endif; ?>
														</div>
													</li>
												</ul>
											</div>
											<div class="order-right">
												<li class="td td-amount">
													<div class="item-amount" style="color: red;">
														合计：<?php echo $value['goods_price']; ?><br>
													</div>
												</li>
												<div class="move-right">
													<li class="td td-status">
														<div class="item-status">
															<?php if($value['order_status'] == 1): ?>
															<p class="Mystatus" style="color: springgreen">交易成功</p>
															<?php elseif($value['order_status'] == 2): ?>
															<p class="Mystatus" style="color: #0b76ac">订单取消</p>
															<?php else: ?>
															<p class="Mystatus" style="color: orangered">交易失败</p>
															<?php endif; ?>
														</div>
													</li>
													<li class="td td-change">
														<a href="<?php echo url('index/person/delOrder'); ?>?id=<?php echo $value['order_id']; ?>"
														   onclick="if(confirm('此操作不可逆，请谨慎操作')==false)return false;">
															<div class="am-btn am-btn-danger anniu" style="position: relative;top: -30px;left: 0;">
																删除订单</div>
														</a>
														<?php if($value['order_status'] == 1): ?>
														<a href="<?php echo url('index/person/commentlist'); ?>?sn=<?php echo $value['order_sn']; ?>">
															<div class="am-btn am-btn-danger anniu">
															评价商品</div>
														</a>
														<?php endif; ?>
													</li>
												</div>
											</div>
										</div>
									</div>


									<?php endforeach; endif; else: echo "" ;endif; ?>






								</div>

							</div>

						</div>
					</div>

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