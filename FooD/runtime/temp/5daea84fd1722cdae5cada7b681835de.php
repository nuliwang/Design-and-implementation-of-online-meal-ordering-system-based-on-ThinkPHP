<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:81:"D:\PHP\wamp64\www\FooD\public/../application/index\view\user\mobile_register.html";i:1621960848;}*/ ?>
<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="UTF-8">
    <title>注册</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="stylesheet" href="/static/AmazeUI-2.4.2/assets/css/amazeui.min.css" />
    <link href="/static/css/dlstyle.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/static/fa/css/font-awesome.min.css">
    <script src="/static/AmazeUI-2.4.2/assets/js/jquery.min.js"></script>
    <script src="/static/AmazeUI-2.4.2/assets/js/amazeui.min.js"></script>
    <script src="/static/layer/layer.js"></script>
    <style>
    /*    img[src=""],img:not([src]){
            opacity:0;
        }*/
    </style>

</head>

<body>

<div class="login-boxtitle">
    <a href="/"><img alt="" style="height: 60px;width: 60px" src="/static/images/FooD.png" /></a>
</div>

<div class="res-banner" style="height: 580px">
    <div class="res-main">
        <div class="login-banner-bg"><span></span><img src="/static/images/FooDbig.png" style="position: absolute;left:100px ;top:50px "/></div>
        <div class="login-box" style="height: 540px">

            <div class="am-tabs" id="doc-my-tabs">
                <ul class="am-tabs-nav am-nav am-nav-tabs am-nav-justify">
                    <li class="am-active"><a href="<?php echo url('Index/user/register'); ?>">用户注册</a></li>
                    <li><a href="<?php echo url('Index/user/mobile_register'); ?>"  style="color: red;">商户注册</a></li>
                </ul>



                    <div class="am-tab-panel">
                        <form>

                            <div class="user-phone">
                                <label for="phone"><i class="am-icon-calendar-plus-o"></i></label>
                                <input type="" name="name" id="name"  placeholder="请输入商家名称">
                            </div>

                            <div class="user-phone">
                                <label for="phone"><i class="am-icon-tag"></i></label>
                                <select id="class_id" style="width: 320px;height: 41px;padding-left: 50px">
                                    <option value="">请选择商家分类</option>
                                    <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                                    <option value="<?php echo $v['classify_id']; ?>"><?php echo $v['name']; ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>

                                </select>
                            </div>

                            <div class="user-phone">
                                <label for="phone"><i class="am-icon-photo"></i></label>
                                <a href="javascript:void(0)" onclick="uploadPhoto()">
                                    <input placeholder="请上传商家logo" style="" disabled />
                                </a>
                                <input type="file" id="photoFile" style="display: none;" onchange="upload()">
                            </div>
                            <div id="display" style="display: none">
                                <img style="display:block;margin: 0 auto" id="preview_photo" src="" height="60px">
                            </div>

                            <input type="hidden" id="logo" name="logo">

                            <div class="user-phone">
                                <label for="phone"><i class="am-icon-mobile-phone am-icon-md"></i></label>
                                <input type="tel" name="mobile" id="phone" placeholder="请输入手机号">
                            </div>
                            <div class="verification">
                                <label for="code"><i class="am-icon-code-fork"></i></label>
                                <input type="tel" name="yzm" id="code" placeholder="请输入验证码" style="width: 215px;">
                                <input type="button"  id="btn" style="width:100px;color: #999;height: 40px;padding-left: 0;" name="sms" value="点击获取">

                            </div>
                            <div class="user-pass">
                                <label for="password"><i class="am-icon-lock"></i></label>
                                <input type="password" name="password" id="password" placeholder="设置密码">
                                <i class="fa fa-eye fa-2x " id="eye" style="position:absolute;left:260px;top:4px;z-index: 999 " ></i>
                            </div>
                            <div class="user-pass">
                                <label for="passwordRepeat"><i class="am-icon-lock"></i></label>
                                <input type="password" name="repassword" id="repassword" placeholder="确认密码">
                            </div>
                       <!--     <div class="user-pass">
                                <label for="passwordRepeat"><i class="am-icon-refresh am-icon-spin"></i></i></label>
                                <input type="text" name="captcha" id="yzm" placeholder="验证码" style="width: 300px;">
                                <p style="margin-top: 10px;"><img src="<?php echo captcha_src(); ?>" alt="captcha" class="passcode" onclick="this.src=this.src+'?'"/></p>
                            </div>
-->



                        <div class="am-cf" style="margin-top: 10px;">
                            <input type="button" name="submit" id="submit" value="注册" class="am-btn am-btn-primary am-btn-sm am-fl">
                        </div>
                        </form>
                        <hr>
                    </div>



                </div>
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
    $('#submit').click(function () {
        var name = $('#name').val();
        var phone = $('#phone').val();
        var logo = $('#logo').val();
        var password = $('#password').val();
        var repassword = $('#repassword').val();
        var code = $('#code').val();
        var class_id = $('#class_id').val();
        if (name == '') {
            layer.alert('商家名称不能为空', {icon: 2});
            return;
        }
        if (class_id == '') {
            layer.alert('请选择商家分类', {icon: 2});
            return;
        }
        $.ajax({
            type:'post',
            url:'/index/user/merchant',
            data: {
                'phone':phone,
                'name':name,
                'logo':logo,
                'password':password,
                'repassword':repassword,
                'code':code,
                'class_id':class_id
            },
            dataType:'json',
            success:function (data) {
             if(data.code==200) {
                 layer.alert(data.msg)//message返回错误信息
                 setTimeout(function () {
                     window.location.href='/backend/login/login';
                 },3000)
             }else {
                 layer.alert(data.msg, {icon: 5});
                 return false;
             }
            }
            }
        )
    })
    var countdown=3000;//3s倒计时
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
    $('#btn').click(function () {
        var phone = $('#phone').val();

        $.ajax({
            type:'post',
            dataType:'json',
            data:{'phone':phone,
                'template':'SMS_209160377'
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

    function uploadPhoto() {
        $("#photoFile").click();
    }

    /**
     * 上传图片
     */
    function upload() {
        if ($("#photoFile").val() == '') {
            return;
        }
        var formData = new FormData();
        formData.append('photo', document.getElementById('photoFile').files[0]);
        $.ajax({
            url:"/index/user/upload",
            type:"post",
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                if(data.code==1){
                    $('#display').css('display','block');
                    console.log(data.data.data);
                    $("#preview_photo").attr("src", data.data.data);
                    $("#logo").val(data.data.data);
                }else {
                    layer.msg(data.msg);
                }


            },
            error:function(data) {
                alert("上传失败")
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