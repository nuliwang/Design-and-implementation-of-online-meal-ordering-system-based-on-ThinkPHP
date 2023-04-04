<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:71:"D:\PHP\wamp64\www\FooD\public/../application/index\view\user\phone.html";i:1620806099;}*/ ?>
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


    <script src="/static/AmazeUI-2.4.2/assets/js/jquery.min.js"></script>
    <script src="/static/AmazeUI-2.4.2/assets/js/amazeui.min.js"></script>
    <script src="/static/layer/layer.js"></script>


    <!--弹窗样式-->


</head>

<body style="background: #fff;">

<div class="login-boxtitle">
    <a href="/"><img alt="logo" src="/static/images/FooD.png" /></a>
</div>

<div class="login-banner" >
    <div class="login-main">
        <a href="/"><div class="login-banner-bg"><span></span><img src="/static/images/FooDbig.png" style="position: absolute;left:100px ;top:50px "/></div></a>
        <div class="login-box" style="height: 300px">

            <h4 class="title">手机号快捷登录</h4>
            <div class="clear"></div>
            <form>
                <div class="login-form">

                    <div class="user-phone">
                        <label for="phone"><i class="am-icon-mobile-phone am-icon-md"></i></label>
                        <input type="tel" name="mobile" id="phone" placeholder="请输入手机号">
                    </div>
                    <div class="verification">
                        <label for="code"><i class="am-icon-code-fork"></i></label>
                        <input type="tel" name="yzm" id="code" placeholder="请输入验证码" style="width: 215px;">
                        <input type="button"  id="btn" style="width:100px;color: #999;height: 40px;padding-left: 0;" name="sms" value="点击获取">
                    </div>
                </div>
                <div class="am-cf" style="">
                    <input type="button" name="" value="登录" class="am-btn am-btn-primary am-btn-sm am-fl" onclick="checkLogin()">
                </div>
                <h5><span style="color: red">短信用完？</span><a href="<?php echo url('/index/user/login'); ?>">换账号登录</a></h5>
            </form>


        </div>
    </div>
</div>


<div class="footer ">
    <div class="footer-hd ">
        <p>
            <a href="# "></a>
            <b>|</b>
            <a href="# ">FooD点餐首页</a>
            <b>|</b>
            <a href="# ">支付宝</a>
            <b>|</b>
            <a href="# ">物流</a>
        </p>
    </div>
    <div class="footer-bd ">
        <p>
            <a href="# "></a>
            <a href="# ">合作伙伴</a>
            <a href="# ">联系我们</a>
            <a href="# ">网站地图</a>
            <em>© 2020-2020 版权所有</em>
        </p>
    </div>
</div>
</body>


<script>
    function checkLogin() {
        var phone = $('#phone').val();
        var code= $('#code').val();

        $.ajax({
            type:'post',
            dataType:'json',
            data:{
                'phone':phone,
                'code':code,
            },
            url:"/index/user/phoneLogin",
            success:function (res) {
                if(res.code==200){
                    //3秒后跳转
                    layer.msg(res.msg, {icon: 6});
                    setTimeout(function () {
                        window.location.href='/'
                    },3000);

                }else {
                    layer.alert(res.msg, {icon: 5});
                }
            }
        });

    }
    var countdown=60;//300s倒计时
    function settime() {
        if (countdown == 0) {
            $("#btn").attr("disabled",false);
            $("#btn").val("免费获取验证码");
            countdown = 300;
            return;
        } else {
            $("#btn").attr("disabled", true);
            $("#btn").val("重新发送(" + countdown + ")");
            countdown--;
        }
        //1s执行一次
        setTimeout(function(){settime()},1000);
    }
    //发送验证码
    $('#btn').click(function () {
        var phone = $('#phone').val();
        $.ajax({
            type:'post',
            dataType:'json',
            data:{
                'phone':phone,
                'template':'SMS_205616486',
                'type':2
            },
            url:"/index/sms/send",
            success:function (res) {
                if(res.state==2){
                    layer.msg(res.msg, {icon: 6});
                    settime();
                }else {
                    layer.alert(res.msg, {icon: 5});
                }
            }
        });
    })
</script>









</html>