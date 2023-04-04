<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:71:"D:\PHP\wamp64\www\FooD\public/../application/index\view\user\login.html";i:1620806099;}*/ ?>
<!DOCTYPE html>
<html>

	<head lang="en">
		<meta charset="UTF-8">
		<title>登录</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta name="format-detection" content="telephone=no">
		<meta name="renderer" content="webkit">
		<meta http-equiv="Cache-Control" content="no-siteapp" />

		<link rel="stylesheet" href="/static/AmazeUI-2.4.2/assets/css/amazeui.css" />
		<link href="/static/css/dlstyle.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="/static/fa/css/font-awesome.min.css">


		<script src="/static/AmazeUI-2.4.2/assets/js/jquery.min.js"></script>
		<script src="/static/AmazeUI-2.4.2/assets/js/amazeui.min.js"></script>
		<script src="/static/layer/layer.js"></script>


		<!--弹窗样式-->


	</head>

	<body style="background: #fff;">

		<div class="login-boxtitle">
			<a href="/"><img alt="logo" style="height: 60px;width: 60px"src="/static/images/FooD.png" /></a>
		</div>

		<div class="login-banner">
			<div class="login-main">
				<!--<a href="/"><div class="login-banner-bg"><span></span><img src="/static/images/big.jpg" /></div></a>-->
				<div class="login-banner-bg"><span></span><img src="/static/images/FooDbig.png" style="position: absolute;left:100px ;top:50px "/></div>
				<div class="login-box">

							<h4 class="title">FooD点餐-登陆</h4>
							<div class="clear"></div>
					<form>
						<div class="login-form">

							   <div class="user-name">
								    <label for=><i class="am-icon-user"></i></label>
								    <input type="text" name="username" id="username" placeholder="用户名 / 手机号 / 邮箱">
                 </div>
                 <div class="user-pass">
								    <label for="password"><i class="am-icon-lock"></i></label>
								    <input type="password" name="password" id="password" placeholder="请输入密码">
					 				<i class="fa fa-eye fa-2x " id="eye" style="position:absolute;left:280px;top:4px;z-index: 999 " ></i>
                 </div>


							  <div class="user-pass">
								  <label for=><i class="am-icon-refresh am-icon-spin"></i></i></label>
								  <input type="text" name="captcha" id="captcha" placeholder="验证码">
								  <p style="margin-top: 10px;"><img src="<?php echo captcha_src(); ?>" alt="captcha" class="passcode" onclick="this.src='<?php echo captcha_src(); ?>?t='+Date.now()"/></p>
							  </div>



           </div>

						<div class="am-cf" style="margin-top: 100px;">
							<input type="button" name="" value="登录" class="am-btn am-btn-primary am-btn-sm am-fl" onclick="checkLogin()">
						</div>
						<h5>
							<span style="color: red">不记得密码？</span><a href="<?php echo url('/index/user/phone'); ?>">换手机号码登录</a>
							<a href="<?php echo url('/index/user/register'); ?>" style="display: inline-block; float: right;color: #0e90d2">注册</a>
						</h5>
					</form>


				</div>
			</div>
		</div>


					<div class="footer ">
						<div class="footer-hd ">
							<p>
								<a href="#"></a>
								<b>|</b>
								<a href="/">FooD点餐首页</a>
								<b>|</b>
								<a href="#">支付宝</a>
								<b>|</b>
								<a href="#">物流</a>
							</p>
						</div>
						<div class="footer-bd ">
							<p>
								<a href="#"></a>
								<a href="#">合作伙伴</a>
								<a href="#">联系我们</a>
								<a href="#">网站地图</a>
								<em>© 2020-2020 版权所有</em>
							</p>
						</div>
					</div>
	</body>


	<script>
        function checkLogin() {
            // var username = $('#username').val();
            // var password = $('#password').val();
            // var captcha = $('#captcha').val();
            $.ajax({
                type:'post',
                dataType:'json',
                data:$('form').serialize(),
                url:"/index/user/doLogin",
                success:function (res) {
                    if(res.code==200){
                        //3秒后跳转
                        layer.msg(res.msg, {icon: 6});
                        setTimeout(function () {
                            window.location.href = '/?t=' + Date.now()
                        },3000);

                    }else {
                        layer.alert(res.msg, {icon: 5});
                        $('img.passcode').attr('src', '<?php echo captcha_src(); ?>?t='+Date.now())
                    }
                }
            });

        }
	</script>
	<script>
		var eye = document.getElementById('eye');
		var pwd = document.getElementById('password');
		var flag = 0;
		eye.onclick = function() {
			if (flag == 0) {
				pwd.type = 'password';
				eye.setAttribute("class","fa fa-eye fa-2x");

				flag = 1;
			} else {
				pwd.type = 'text';
				eye.setAttribute("class","fa fa-eye-slash fa-2x");
				flag = 0;
			}

		}

	</script>



</html>