<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:76:"D:\PHP\wamp64\www\FooD\public/../application/backend\view\index\welcome.html";i:1620872936;s:64:"D:\PHP\wamp64\www\FooD\application\backend\view\layout\head.html";i:1620872936;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
<title>FooD点餐系统</title>
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
<meta http-equiv="Cache-Control" content="no-siteapp" />

<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" href="/admin/css/font.css">
<link rel="stylesheet" href="/admin/css/xadmin.css">
<script type="text/javascript" src="/admin/js/jquery.min.js"></script>
<script src="/admin/lib/layui/layui.js" charset="utf-8"></script>
<script type="text/javascript" src="/admin/js/xadmin.js"></script>
</head>
<body>
<div class="x-body layui-anim layui-anim-up">
    <blockquote class="layui-elem-quote">
    <?php if(session('type')==1): ?>
    欢迎管理员：
    <?php else: ?>
    欢迎商户：
    <?php endif; ?>
    <span class="x-red"><?php echo session('user')['name']; ?></span>！当前时间:<?php echo getTime(); ?></blockquote>
</div>

</body>
</html>