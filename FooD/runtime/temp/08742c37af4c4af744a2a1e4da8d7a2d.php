<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:75:"D:\PHP\wamp64\www\FooD\public/../application/index\view\person\address.html";i:1620806097;s:74:"D:\PHP\wamp64\www\FooD\application\index\view\common\form_address_add.html";i:1620806095;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">
	<title>地址管理</title>
	<link href="/static/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
	<link href="/static/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">
	<link href="/static/css/personal.css" rel="stylesheet" type="text/css">
	<link href="/static/css/addstyle.css" rel="stylesheet" type="text/css">
	<script src="/static/AmazeUI-2.4.2/assets/js/jquery.min.js" type="text/javascript"></script>
	<script src="/static/AmazeUI-2.4.2/assets/js/amazeui.js"></script>
	<script src="/static/distpicker-2.0.6/dist/distpicker.min.js"></script>
</head>

	<body>
		<!--头 -->
		<header>
			<article>
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

					<div class="user-address">
						<!--标题 -->
						<div class="am-cf am-padding">
							<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">地址管理</strong> / <small>Address&nbsp;list</small></div>
						</div>
						<hr/>
						<ul class="am-avg-sm-1 am-avg-md-3 am-thumbnails">




							<?php if(is_array($adInfo) || $adInfo instanceof \think\Collection || $adInfo instanceof \think\Paginator): $i = 0; $__LIST__ = $adInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;if($value['is_default']==1): ?>
							<li class="user-addresslist defaultAddr">

								<?php elseif($value['is_default']==0): ?>
							<li class="user-addresslist" style="border: 1px solid #999;margin-bottom: 10px;">
								<?php endif; ?>

								<span class="new-option-r"><i class="am-icon-check-circle"></i><a href="<?php echo url('index/person/defaultAd'); ?>?id=<?php echo $value['address_id']; ?>" onclick="if(confirm('你确定要设为默认地址吗？')==false)return false;">设为默认</a></span>
								<p class="new-tit new-p-re">
									<span class="new-txt"><?php echo $value['consignee']; ?></span>
									<span class="new-txt-rd2"><?php echo $value['phone']; ?></span>
								</p>
								<div class="new-mu_l2a new-p-re">
									<p class="new-mu_l2cw">
										<span class="title">地址：</span>
										<span><?php echo $value['address_info']; ?></span></p>
								</div>
								<div class="new-addr-btn">
									<a href="<?php echo url('index/person/updateaddress'); ?>?id=<?php echo $value['address_id']; ?>" onclick="if(confirm('你确定要编辑此地址吗？')==false)return false;"><i class="am-icon-edit"></i>编辑</a>
									<span class="new-addr-bar">|</span>
									<a href="<?php echo url('index/person/deladdress'); ?>?id=<?php echo $value['address_id']; ?>" onclick="if(confirm('你确定要删除此地址吗？')==false)return false;"><i class="am-icon-trash"></i>删除</a>
								</div>
							</li>
							<?php endforeach; endif; else: echo "" ;endif; ?>

						</ul>
						<div class="clear"></div>
						<a class="new-abtn-type" data-am-modal="{target: '#doc-modal-1', closeViaDimmer: 0}">添加新地址</a>
						<!--例子-->
						<!--标题 -->
<div class="am-cf am-padding">
	<div class="am-modal-hd am-fl am-cf">
		<strong class="am-text-danger am-text-lg">新增地址</strong> / <small>Add address</small>
	</div>
</div>
<hr/>

<div class="am-u-md-12 am-modal-bd" style="max-width: 600px;border-bottom: none">
	<form class="am-form am-form-horizontal" id="form-address-add">
		<div class="am-form-group">
			<label for="user-name" class="am-form-label">收货人</label>
			<div class="am-form-content">
				<input type="text" name="consignee" placeholder="收货人">
			</div>
		</div>

		<div class="am-form-group">
			<label for="user-phone" class="am-form-label">手机号码</label>
			<div class="am-form-content">
				<input name="phone" placeholder="手机号必填" type="text">
			</div>
		</div>

		<div class="am-form-group">
			<label for="user-phone" class="am-form-label">所在地</label>
			<div id="distpicker-add" class="am-form-content address" style="display: flex">
				<select name="province" data-province="—— 省 ——"></select>
				<select name="city" data-city="—— 市 ——"></select>
				<select name="district" data-district="—— 区 ——"></select>
			</div>
		</div>

		<div class="am-form-group">
			<label for="user-intro" class="am-form-label">详细地址</label>
			<div class="am-form-content" style="
    display: flex;
    flex-direction: column;
    align-items: flex-start;
">
				<textarea class="" rows="3" name="address" placeholder="100字以内写出你的详细地址..."></textarea>
				<!--<small style="color: #aaa">100字以内写出你的详细地址...</small>-->
			</div>
		</div>

		<div class="am-form-group theme-poptit">
			<div class="am-u-sm-9 am-u-sm-push-3" style="position: relative;left:50px;">
				<a href="javascript:;" id="add-address-submit" class="am-btn am-btn-danger">确定</a>
				<?php if(!(empty($isPopover) || (($isPopover instanceof \think\Collection || $isPopover instanceof \think\Paginator ) && $isPopover->isEmpty()))): ?>
				<div class="am-btn am-btn-danger close" data-am-modal-close>取消</div>
				<?php endif; ?>
			</div>
		</div>
	</form>
	<script>
		$(function(){
			let dpAdd = $('#distpicker-add').distpicker(),
				my_alert = $('#doc-modal-alert');
			$(document).on('click', '#add-address-submit', function (){
				$.ajax({
					type: "POST",
					url: "<?php echo url('index/person/addAddress'); ?>",
					dataType: "json",
					data: $('#form-address-add').serialize(),
					success: function(data){
						if(my_alert.length === 0){
							alert(data.msg)
						} else {
							$('#doc-modal-alert-info').text(data.msg)
							my_alert.modal('open')
						}
						setTimeout(function () {
							window.location.reload()
						},2000)
					}
				})
			})

		})
	</script>
</div>

					</div>

					<script type="text/javascript">
						$(document).ready(function() {							
							$(".new-option-r").click(function() {
								$(this).parent('.user-addresslist').addClass("defaultAddr").siblings().removeClass("defaultAddr");
							});
							
							var $ww = $(window).width();
							if($ww>640) {
								$("#doc-modal-1").removeClass("am-modal am-modal-no-btn")
							}
							
						})
					</script>

					<div class="clear"></div>

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