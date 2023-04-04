<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"D:\PHP\wamp64\www\FooD\public/../application/index\view\person\information.html";i:1620806098;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">
	<title>个人资料</title>
	<link href="/static/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
	<link href="/static/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">
	<link href="/static/css/personal.css" rel="stylesheet" type="text/css">
	<link href="/static/css/infstyle.css" rel="stylesheet" type="text/css">
	<link href="/static/css/datepicker.css" rel="stylesheet" type="text/css">
	<script src="/static/AmazeUI-2.4.2/assets/js/jquery.min.js" type="text/javascript"></script>
	<script src="/static/AmazeUI-2.4.2/assets/js/amazeui.js" type="text/javascript"></script>
	<script src="/static/js/moment.min.js"></script>
	<script src="/static/js/datepicker.all.js"></script>
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
				<div class="user-info">
					<!--标题 -->
					<div class="am-cf am-padding">
						<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">个人资料</strong> / <small style="color: red;">请尽快完成个人的基本信息，以保证安全</small></div>
					</div>
					<hr/>

					<!--头像 -->
					<div class="user-infoPic">

						<div class="filePic">
							<input type="file" class="inputPic" allowexts="gif,jpeg,jpg,png,bmp" accept="image/*">
							<?php if(empty($info['0']['head_pic']) || (($info['0']['head_pic'] instanceof \think\Collection || $info['0']['head_pic'] instanceof \think\Paginator ) && $info['0']['head_pic']->isEmpty())): ?>
							<img src="#" alt="">
							<?php else: ?>
							<img class="am-circle am-img-thumbnail" src="<?php echo $info['0']['head_pic']; ?>" alt="" />
							<?php endif; ?>
						</div>

						<p class="am-form-help">头像</p>
							<form action="<?php echo url('index/person/updatePic'); ?>" method="post" enctype="multipart/form-data">
						<div class="info-m">
							<div></div>
							<input type="file" name="image" id="" /><br>
							<button style="height: 30px;background: #0c7cb5;">更改头像</button>

						</div>
							</form>
					</div>


					<!--个人信息 -->
					<div class="info-main">
						<form class="am-form am-form-horizontal" action="<?php echo url('index/person/updateInfo'); ?>" method="post">

							<div class="am-form-group">
								<label for="user-name2" class="am-form-label">账号昵称</label>
								<div class="am-form-content">
									<?php if(empty($info['0']['username'])): ?>
									<input type="text" name="username" placeholder="" style="color: #0d86c4;" value="<?php echo $info['0']['username']; ?>">
									<p style="color: red;">如果你还未设置该账号，请尽快完成相关设置，该账号具有唯一性，仅有一次修改的权限，请谨慎操作</p>

									<?php elseif(!empty($info['0']['username'])): ?>
									<input type="text" name="username" style="color: #0d86c4;" placeholder="账号昵称" disabled = "disabled" value="<?php echo $info['0']['username']; ?>">
									<p style="color: red;">该账号具有唯一性，此项不可更改</p>
									<?php endif; ?>


								</div>
							</div>
<br>
							<div class="am-form-group">
								<label for="user-name" class="am-form-label">QQ</label>
								<div class="am-form-content">
									<input type="text" name="qq" placeholder="QQ" value="<?php echo $info['0']['qq']; ?>">

								</div>
							</div>

							<div class="am-form-group">
								<label class="am-form-label">性别</label>
								<?php if($info['0']['sex']==0): ?>
								<div class="am-form-content sex">
									<label class="am-radio-inline">
										<input type="radio" name="sex" value="1" data-am-ucheck> 男
									</label>
									<label class="am-radio-inline">
										<input type="radio" name="sex" value="2" data-am-ucheck> 女
									</label>
									<label class="am-radio-inline">
										<input type="radio" name="sex" value="0" data-am-ucheck checked> 保密
									</label>
								</div>
								<?php elseif($info['0']['sex']==1): ?>
								<div class="am-form-content sex">
									<label class="am-radio-inline">
										<input type="radio" name="sex" value="1" data-am-ucheck checked> 男
									</label>
									<label class="am-radio-inline">
										<input type="radio" name="sex" value="2" data-am-ucheck> 女
									</label>
									<label class="am-radio-inline">
										<input type="radio" name="sex" value="0" data-am-ucheck > 保密
									</label>
								</div>
								<?php elseif($info['0']['sex']==2): ?>
								<div class="am-form-content sex">
									<label class="am-radio-inline">
										<input type="radio" name="sex" value="1" data-am-ucheck > 男
									</label>
									<label class="am-radio-inline">
										<input type="radio" name="sex" value="2" data-am-ucheck checked> 女
									</label>
									<label class="am-radio-inline">
										<input type="radio" name="sex" value="0" data-am-ucheck > 保密
									</label>
								</div>
								<?php endif; ?>
							</div>

							<div class="am-form-group">
								<label for="user-name" class="am-form-label">生日</label>
								<div class="am-form-content">
<!--										<input type="text" name="brithday" placeholder="生日" value="<?php echo $info['0']['brithday']; ?>">-->
									<div class="c-datepicker-date-editor c-datepicker-single-editor J-datepickerTime-single mt10">
<!--											<i class="c-datepicker-range__icon kxiconfont icon-clock"></i>-->
										<input type="text" autocomplete="off" name="brithday" placeholder="选择日期"
											   style="border: none"
											   class=" c-datepicker-data-input" value="<?php echo $info['0']['brithday']; ?>">
									</div>
									<script>
										$(function(){
											$('.J-datepickerTime-single').datePicker({
												format: 'YYYY-MM-DD'
											});
										})
									</script>
								</div>
							</div>
							<div class="am-form-group">
								<label for="user-phone" class="am-form-label">电话</label>
								<div class="am-form-content">
									<input name="phone" placeholder="手机号码" type="tel" value="<?php echo $info['0']['mobile']; ?>" >

								</div>
							</div>
							<div class="am-form-group">
								<label for="user-email" class="am-form-label">电子邮箱</label>
								<div class="am-form-content">
									<input name="email" placeholder="Email" type="email" value="<?php echo $info['0']['email']; ?>">

								</div>
							</div>

							<div class="am-form-group safety">
								<label for="user-safety" class="am-form-label">账号安全</label>
								<div class="am-form-content safety">
									<a href="safety.html">

										<span class="am-icon-angle-right"></span>

									</a>

								</div>
							</div>
							<div class="info-btn" style="margin-left: -600px;">
								<input type="submit" value="确定修改" style="width: 100px;height: 30px;text-align: center;background: orangered;" />
							</div>

						</form>
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