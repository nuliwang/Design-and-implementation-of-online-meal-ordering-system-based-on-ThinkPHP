<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"D:\PHP\wamp64\www\FooD\public/../application/index\view\goods\introduction.html";i:1620806096;}*/ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

	<title>商品页面</title>

	<link href="/static/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css" />
	<link href="/static/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css" />
	<link href="/static/basic/css/demo.css" rel="stylesheet" type="text/css" />
	<link type="text/css" href="/static/css/optstyle.css" rel="stylesheet" />
	<link type="text/css" href="/static/css/style.css" rel="stylesheet" />

	<script type="text/javascript" src="/static/basic/js/jquery-1.7.min.js"></script>
	<script type="text/javascript" src="/static/basic/js/quick_links.js"></script>

	<script type="text/javascript" src="/static/AmazeUI-2.4.2/assets/js/amazeui.js"></script>
	<script type="text/javascript" src="/static/js/jquery.imagezoom.min.js"></script>
	<script type="text/javascript" src="/static/js/jquery.flexslider.js"></script>


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
						<a href="#" target="_top">免费<span style="color: red"> 注册 </span></a>
						<?php elseif(!empty(\think\Session::get('id'))): ?>
						尊敬的会员：<span style="color: red"> <?php echo \think\Session::get('username'); ?> </span>
						<?php endif; ?>
					</div>
				</div>
			</ul>
			<ul class="message-r">
				<div class="topMessage home">
					<div class="menu-hd"><a href="<?php echo url('index/index/index'); ?>" target="_top" class="h">Food点餐首页</a></div>
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
			</div></ul>
		</div>

		<!--悬浮搜索框-->

		<div class="nav white">
			<div class="logo"><img src="/static/images/FooD.png" /></div>
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

		<b class="line"></b>

		<div class="listMain">

			<!--分类-->
			<div class="nav-table">
			   	<div class="long-title"><span class="all-goods">全部分类</span></div>
				   <div class="nav-cont">
						<ul>
							<li class="index"><a href="/">首页</a></li>

						</ul>

					</div>
				</div>
				<ol class="am-breadcrumb am-breadcrumb-slash">
					<li><a href="#">首页</a></li>
					<li><a href="#">分类</a></li>
					<li class="am-active">内容</li>
				</ol>
				<script type="text/javascript">
					$(function() {});
					$(window).load(function() {
						$('.flexslider').flexslider({
							animation: "slide",
							start: function(slider) {
								$('body').removeClass('loading');
							}
						});
					});
				</script>

				<div class="scoll">
					<section class="slider">
						<div class="flexslider">
							<ul class="slides">
								<li>
									<img src="<?php echo $goodsInfo['0']['imgpath']; ?>" title="pic" />
								</li>
								<li>
									<img src="<?php echo $goodsInfo['0']['imgpath']; ?>" />
								</li>
								<li>
									<img src="<?php echo $goodsInfo['0']['imgpath']; ?>" />
								</li>
							</ul>
						</div>
					</section>
				</div>

				<!--放大镜-->
				<div class="item-inform">
					<div class="clearfixLeft" id="clearcontent">

						<div class="box">
							<script type="text/javascript">
								$(document).ready(function() {
									$(".jqzoom").imagezoom();
									$("#thumblist li a").click(function() {
										$(this).parents("li").addClass("tb-selected").siblings().removeClass("tb-selected");
										$(".jqzoom").attr('src', $(this).find("img").attr("mid"));
										$(".jqzoom").attr('rel', $(this).find("img").attr("big"));
									});
								});
							</script>

							<div class="tb-booth tb-pic tb-s310">
								<a href="<?php echo $goodsInfo['0']['imgpath']; ?>"><img src="<?php echo $goodsInfo['0']['imgpath']; ?>" alt="细节展示放大镜特效" rel="<?php echo $goodsInfo['0']['imgpath']; ?>" class="jqzoom" /></a>
							</div>
							<ul class="tb-thumb" id="thumblist">
								<li class="tb-selected">
									<div class="tb-pic tb-s40">
										<a href="#"><img src="<?php echo $goodsInfo['0']['imgpath']; ?>" mid="<?php echo $goodsInfo['0']['imgpath']; ?>" big="<?php echo $goodsInfo['0']['imgpath']; ?>"></a>
									</div>
								</li>
							</ul>
						</div>

						<div class="clear"></div>
					</div>

					<div class="clearfixRight">

						<!--规格属性-->

						<!--名称-->
						<div class="tb-detail-hd">
							<h1><?php echo $goodsInfo['0']['good_name']; ?></h1>
						</div>
						<div class="tb-detail-list">
							<!--价格-->
							<div class="tb-detail-price">
								<li class="price iteminfo_price">
									<dt>促销价</dt>
									<dd><em>¥</em><b class="sys_item_price"><?php echo $goodsInfo['0']['price']; ?></b>  </dd>
								</li>
								<li class="price iteminfo_mktprice">
									<dt>原价</dt>
									<dd><em>¥</em><b class="sys_item_mktprice"><?php echo $goodsInfo['0']['market']; ?></b></dd>
								</li>
								<div class="clear"></div>
							</div>

							<!--地址-->
							<dl class="iteminfo_parameter freight">
								<dt>配送至</dt>
								<div class="iteminfo_freprice">
									<div class="am-form-content address">
										<select data-am-selected>
											<option value="a">福建省</option>

										</select>
										<select data-am-selected>
											<option value="a">厦门市</option>

										</select>

									</div>
									<div class="pay-logis">
										预计1小时达
									</div>
								</div>
							</dl>
							<div class="clear"></div>

							<!--销量-->
							<ul class="tm-ind-panel">

								<li class="tm-ind-item tm-ind-sumCount canClick">
									<div class="tm-indcon">
										<span class="tm-label">累计销量</span>
										<span class="tm-count"><?php echo $goodsInfo['0']['sales_count']; ?></span>
									</div>
								</li>
								<li class="tm-ind-item tm-ind-reviewCount canClick tm-line3">
									<div class="tm-indcon">
										<span class="tm-label">累计评价</span>
										<span class="tm-count"><?php echo $sum; ?></span>
									</div>
								</li>
							</ul>
							<div class="clear"></div>

							<!--各种规格-->
							<dl class="iteminfo_parameter sys_item_specpara">
								<dt class="theme-login"><div class="cart-title">可选规格<span class="am-icon-angle-right"></span></div></dt>
								<dd>
									<!--操作页面-->
									<div class="theme-popover-mask"></div>

									<div class="theme-popover">
										<div class="theme-span"></div>
										<div class="theme-poptit">
											<a href="javascript:;" title="关闭" class="close">×</a>
										</div>
										<div class="theme-popbod dform">
											<form class="theme-signin" name="loginform" action="" method="post">

												<div class="theme-signin-left">

													<div class="theme-options">
														<div class="cart-title">分量</div>
														<ul>
															<li class="sku-line selected">单人份<i></i></li>

														</ul>
													</div>
													<div class="theme-options">
														<div class="cart-title">包装</div>
														<ul>
															<li class="sku-line selected">简易包装<i></i></li>
															<li class="sku-line">保温包装<i></i></li>

														</ul>
													</div>
													<div class="theme-options">
														<div class="cart-title number">数量</div>
														<div style="line-height: 2.75em">
															<input id="min" class="edit-num" name="" type="button" value="-" />
															<input id="text_box" name="" type="text" value="1" style="width:30px;" />
															<input id="add" class="edit-num" name="" type="button" value="+" />
															<span id="Stuck" class="tb-hidden">库存<span class="stock"><?php echo $goodsInfo['0']['repertory']; ?></span>件</span>
														</div>
													</div>
													<div class="clear"></div>

													<div class="btn-op">
														<div class="btn am-btn am-btn-warning">确认</div>
														<div class="btn close am-btn am-btn-warning">取消</div>
													</div>
												</div>
												<div class="theme-signin-right">
													<div class="img-info">
														<img src="/static/images/songzi.jpg" />
													</div>
													<div class="text-info">
														<span class="J_Price price-now">¥39.00</span>
														<span id="Stock" class="tb-hidden">库存<span class="stock">1000</span>件</span>
													</div>
												</div>

											</form>
										</div>
									</div>

								</dd>
							</dl>
							<div class="clear"></div>
							<!--活动	-->
							<div class="shopPromotion gold">
								<div class="hot">
									<dt class="tb-metatit">推荐理由</dt>
									<div class="gold-list">
										<p><?php echo $goodsInfo['0']['desc']; ?><i class="am-icon-sort-down"></i></span></p>
									</div>
								</div>

							</div>
						</div>

						<div class="pay">
							<div class="pay-opt">
							<a href="home.html"><span class="am-icon-home am-icon-fw">首页</span></a>
							<a><span class="am-icon-heart am-icon-fw">收藏</span></a>
							
							</div>

							<li >
								<div class="clearfix tb-btn tb-btn-buy theme-login">
									<a id="LikBy" title="点此按钮收藏" href="<?php echo url('index/goods/addCollection'); ?>?id=<?php echo $goodsInfo['0']['goods_id']; ?>" onclick="if(confirm('你确定要收藏此商品吗？')==false)return false;">点击收藏</a>
								</div>
							</li>
							<li style="margin-left: -60px;">
								<div class="clearfix tb-btn tb-btn-buy theme-login">
									<a id="LikBuy" title="点此按钮到下一步确认下单信息" href="<?php echo url('index/orders/pay'); ?>?id=<?php echo $goodsInfo['0']['goods_id']; ?>&sum=">立即下单</a>
								</div>
							</li>
							<li>
								<div class="clearfix tb-btn tb-btn-basket theme-login">
									<a id="LikBasket" title="加入购物车" href="<?php echo url('index/goods/addcar'); ?>?id=<?php echo $goodsInfo['0']['goods_id']; ?>&num=" <?php if(!empty(\think\Session::get('id'))): ?>
									   onclick="if(confirm('你确定加入此商品吗？')==false)return false;" <?php endif; ?>>
									加入购物车</a>
								</div>
							</li>
						<br><br>
						</div>

					</div>

					<div class="clear"></div>

				</div>

				<!--优惠套装-->

				<div class="clear"></div>


		<!-- introduce-->
		<div class="introduce">
					<div class="browse">
					    <div class="mc" style="padding: .25em .75em .25em .25em">
							<div style="display: block;width: 100%;height: 300px;"></div>
							<div style="display: block;width: 100%;height: 500px;margin-top: 1em"></div>
							<div style="display: block;width: 100%;height: 300px;margin-top: 1em"></div>
					    </div>
					</div>
					<div class="introduceMain">
						<div class="am-tabs" data-am-tabs>
							<ul class="am-avg-sm-3 am-tabs-nav am-nav am-nav-tabs">
								<li class="am-active">
									<a href="javascript:;">
										<span class="index-needs-dt-txt">菜品详情</span></a>
								</li>

								<li>
									<a href="javascript:;">
										<span class="index-needs-dt-txt">全部评价</span></a>
								</li>


							</ul>

							<div class="am-tabs-bd">

								<div class="am-tab-panel am-active">
									<div class="J_Brand">

										<div class="attr-list-hd tm-clear">
											商品具有中国强制性产品认证（CCC）编号，符合国家CCC认证标准。
										</div>

										<div class="clear"></div>

									</div>

									<div class="details">
										<div class="attr-list-hd after-market-hd">
											<h4>菜品细节</h4>
										</div>
										<div class="twlistNews">
											<?php echo $goodsInfo['0']['detail']; ?>

										</div>
									</div>
									<div class="clear"></div>

								</div>

								<div class="am-tab-panel">
									
                                    <div class="actor-new">
                                    	<div class="rate">                
                                    		<strong><?php echo $ratio; ?>%</strong><br> <span>好评度</span>
                                    	</div>
                                        <dl>                    
                                            <dt>买家印象</dt>                    
                                            <dd class="p-bfc">
												<?php if(empty($comment)): ?><q class="comm-tags"><span>该商品暂无评价</span></q><?php endif; ?>
											</dd>
										</dl>
                                    </div>
                                    <div class="clear"></div>
									<div class="tb-r-filter-bar">
										<ul class=" tb-taglist am-avg-sm-4">
											<li class="tb-taglist-li tb-taglist-li-current">
												<div class="comment-info">
													<span>全部评价</span>
													<span class="tb-tbcr-num">(<?php echo $sum; ?>)</span>
												</div>
											</li>

											<li class="tb-taglist-li tb-taglist-li-1">
												<div class="comment-info">
													<span>好评</span>
													<span class="tb-tbcr-num">(<?php echo $good; ?>)</span>
												</div>
											</li>

											<li class="tb-taglist-li tb-taglist-li-0">
												<div class="comment-info">
													<span>中评</span>
													<span class="tb-tbcr-num">(<?php echo $ordinary; ?>)</span>
												</div>
											</li>

											<li class="tb-taglist-li tb-taglist-li--1">
												<div class="comment-info">
													<span>差评</span>
													<span class="tb-tbcr-num">(<?php echo $bad; ?>)</span>
												</div>
											</li>
										</ul>
									</div>

									<div class="clear"></div>

									<ul class="am-comments-list am-comments-list-flip">
										<?php if(is_array($comment) || $comment instanceof \think\Collection || $comment instanceof \think\Paginator): $i = 0; $__LIST__ = $comment;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
										<li class="am-comment">
											<!-- 评论容器 -->
											<a href="">
												<img class="am-comment-avatar" src="<?php echo $value['head_pic']; ?>" />
												<!-- 评论者头像 -->
											</a>

											<div class="am-comment-main" style="margin-bottom: 1em">
												<!-- 评论内容容器 -->
												<header class="am-comment-hd">
													<!--<h3 class="am-comment-title">评论标题</h3>-->
													<div class="am-comment-meta">
														<!-- 评论元数据 -->
														<a href="#link-to-user" class="am-comment-author"><?php echo $value['username']; ?></a>
														<!-- 评论者 -->
														评论于
														<time datetime=""><?php echo date('Y-m-d H:s:i',$value['say_time']); ?></time>
														<?php switch($value['goods_rand']): case "1": ?><span style="color: red;padding-left: 20px;">好评</span><?php break; case "2": ?><span style="color: #B5621B;padding-left: 20px;">中评</span><?php break; case "3": ?><span style="color: coral;padding-left: 20px;">差评</span><?php break; default: ?>无
														<?php endswitch; ?>
													</div>
												</header>

												<div class="am-comment-bd">
													<div class="tb-rev-item " data-id="255776406962">
														<div class="J_TbcRate_ReviewContent tb-tbcr-content ">
															<?php echo $value['content']; ?>
														</div>
														<div>
															<?php $curr_img_path = !empty($value['comment_img']);if($curr_img_path == true): ?>
															<img src="<?php echo $value['comment_img']; ?>" alt="<?php echo $goodsInfo[0]['good_name']; ?>" style="max-width: 100px;max-height: 100px">
															<?php endif; ?>
																</div>
													</div>

												</div>
												<!-- 评论内容 -->
											</div>
										</li>
										<?php endforeach; endif; else: echo "" ;endif; ?>
									</ul>

									<div class="clear"></div>

									<div class="tb-reviewsft">
										<div class="tb-rate-alert type-attention">购买前请查看该商品的 <a href="#" target="_blank">购物保障</a>，明确您的售后保障权益。</div>
									</div>

								</div>

								<div class="am-tab-panel am-fade">
									<div class="like">
										<ul class="am-avg-sm-2 am-avg-md-3 am-avg-lg-4 boxes">

											<?php if(is_array($recommend2) || $recommend2 instanceof \think\Collection || $recommend2 instanceof \think\Paginator): $i = 0; $__LIST__ = $recommend2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>

											<li>
												<div class="i-pic limit">
													<a href="<?php echo url('index/goods/introduction'); ?>?id=<?php echo $value['goods_id']; ?>"><img src="<?php echo $value['imgpath']; ?>" /></a>
													<p>【<?php echo $value['good_name']; ?>】
														</p>
													<p class="price fl">
														<b>¥</b>
														<strong style="color: red;"><?php echo $value['price']; ?></strong>
													</p>
												</div>
											</li>
											<?php endforeach; endif; else: echo "" ;endif; ?>
										</ul>
									</div>
									<div class="clear"></div>



						<div class="footer">
							<div class="footer-hd">
								<p>
									<a href="#"></a>
									<b>|</b>
									<a href="#">Food点餐首页</a>
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
			</div>

			<!--菜单 -->
			</div>
		</div>
	</div>
	<script>
		$('#min').off()
		$('#add').off()
		$('.edit-num').on('click', function (e){
			let cur_num = parseInt($('#text_box').val()),new_num=''
			e.stopPropagation()
			if($(e.target)[0].id === 'min'){
				if (cur_num > 1) {
					new_num = cur_num - 1
					$('#text_box').val(new_num)
					$('#add').attr('disabled', false);
				}else{
					$('#min').attr('disabled', true);
				}
			} else if ($(e.target)[0].id === 'add'){
				if (cur_num < parseInt('<?php echo $goodsInfo['0']['repertory']; ?>')) {
					new_num = cur_num + 1
					$('#text_box').val(new_num)
					$('#min').attr('disabled', false);
				}else{
					new_num = cur_num
					$('#add').attr('disabled', true);
				}
			}

			$('#LikBuy').attr('href', '<?php echo url('index/orders/pay'); ?>?id=<?php echo $goodsInfo['0']['goods_id']; ?>&num=' + new_num)
			$('#LikBasket').attr('href', '<?php echo url('index/goods/addcar'); ?>?id=<?php echo $goodsInfo['0']['goods_id']; ?>&num=' + new_num)
		})
	</script>
</body>
</html>