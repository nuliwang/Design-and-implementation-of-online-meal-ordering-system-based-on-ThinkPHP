<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:75:"D:\PHP\wamp64\www\FooD\public/../application/index\view\person\comment.html";i:1620806098;}*/ ?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">

		<title>评价管理</title>

		<link href="/static/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
		<link href="/static/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">

		<link href="/static/css/personal.css" rel="stylesheet" type="text/css">
		<link href="/static/css/cmstyle.css" rel="stylesheet" type="text/css">

		<script src="/static/AmazeUI-2.4.2/assets/js/jquery.min.js"></script>
		<script src="/static/AmazeUI-2.4.2/assets/js/amazeui.js"></script>

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
						</div>-</ul>
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

					<div class="user-comment">
						<!--标题 -->
						<div class="am-cf am-padding">
							<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">评价管理</strong> / <small>Manage&nbsp;Comment</small></div>
						</div>
						<hr/>

						<div class="am-tabs am-tabs-d2 am-margin" data-am-tabs>

							<ul class="am-avg-sm-2 am-tabs-nav am-nav am-nav-tabs">
								<li class="am-active"><a href="#tab1">所有评价</a></li>
								<li><a href="#tab2">有图评价</a></li>

							</ul>

							<div class="am-tabs-bd">
								<div class="am-tab-panel am-fade am-in am-active" id="tab1">

									<div class="comment-main">
										<div class="comment-list">
											<ul class="item-list">
												<div class="comment-top">
													<div class="th th-price">
														<td class="td-inner">评价</td>
													</div>
													<div class="th th-item">
														<td class="td-inner">商品</td>
													</div>
												</div>
												<hr>
												<?php if(is_array($comment) || $comment instanceof \think\Collection || $comment instanceof \think\Paginator): $i = 0; $__LIST__ = $comment;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>

												<div class="clear"></div>

												<li class="td td-item">
													<div class="item-pic">
														<a href="<?php echo url('index/goods/introduction'); ?>?id=<?php echo $value['goods_id']; ?>" class="J_MakePoint">
															<img src="<?php echo $value['imgpath']; ?>" class="itempic">
														</a>
													</div>
												</li>

												<li class="td td-comment">
													<div class="item-title">

														<div class="item-name">
															<a href="#">
																<p class="item-basic-info"><?php echo $value['good_name']; ?></p>
															</a>
														</div>
														<span data-rand="<?php echo $value['goods_rand']==1; ?>">
															<?php switch($value['goods_rand']): case "1": ?>好评<?php break; case "2": ?>中评<?php break; case "3": ?>差评<?php break; default: ?>无
															<?php endswitch; ?>
														</span>
													</div>
													<div class="item-comment">【<?php echo $value['good_name']; ?>】

														<p><?php echo $value['content']; ?></p>
													</div>
												</li>
												<div class="clear"></div>
												<?php endforeach; endif; else: echo "" ;endif; ?>
											</ul>
										</div>
									</div>

								</div>
								<div class="am-tab-panel am-fade" id="tab2">
									
									<div class="comment-main">
										<div class="comment-list">
											<ul class="item-list">
												
												<div class="comment-top">
													<div class="th th-price">
														<td class="td-inner">评价</td>
													</div>
													<div class="th th-item">
														<td class="td-inner">商品</td>
													</div>
												</div>
												<?php if(is_array($comment2) || $comment2 instanceof \think\Collection || $comment2 instanceof \think\Paginator): $i = 0; $__LIST__ = $comment2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
												<div class="clear"></div>
												<li class="td td-item">
													<div class="item-pic">
														<a href="#" class="J_MakePoint">
															<img src="<?php echo $value['imgpath']; ?>" class="itempic">
														</a>
													</div>
												</li>											
												
												<li class="td td-comment">
													<div class="item-title">
														<div class="item-name">
															<a href="#">
																<p class="item-basic-info"><?php echo $value['good_name']; ?></p>
															</a>
															<span>
															<?php switch($value['goods_rand']): case "1": ?>好评<?php break; case "2": ?>中评<?php break; case "3": ?>差评<?php break; default: ?>无
															<?php endswitch; ?>
															</span>
														</div>
													</div>
													<div class="item-comment">
														【<?php echo $value['good_name']; ?>】
													<div class="filePic">
														<?php if(empty($value['comment_img']) || (($value['comment_img'] instanceof \think\Collection || $value['comment_img'] instanceof \think\Paginator ) && $value['comment_img']->isEmpty())): ?>
														<img src="#" alt="">
														<?php else: ?>
														<img src="<?php echo $value['comment_img']; ?>" alt="">
														<?php endif; ?>
													</div>
													</div>
												</li>
												<div style="margin: 0 0 1em"></div>
												<div class="clear"></div>
												<?php endforeach; endif; else: echo "" ;endif; ?>
											</ul>
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