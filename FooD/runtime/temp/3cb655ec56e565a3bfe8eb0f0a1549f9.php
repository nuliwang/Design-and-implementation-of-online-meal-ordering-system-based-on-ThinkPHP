<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:75:"D:\PHP\wamp64\www\FooD\public/../application/index\view\merchant\index.html";i:1620806096;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>商家详情</title>

    <link href="/static/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css"/>
    <link href="/static/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css"/>
    <link href="/static/basic/css/demo.css" rel="stylesheet" type="text/css"/>
    <link type="text/css" href="/static/css/optstyle.css" rel="stylesheet"/>
    <link type="text/css" href="/static/css/style.css" rel="stylesheet"/>

    <script type="text/javascript" src="/static/basic/js/jquery-1.7.min.js"></script>
    <script type="text/javascript" src="/static/basic/js/quick_links.js"></script>

    <script type="text/javascript" src="/static/AmazeUI-2.4.2/assets/js/amazeui.js"></script>
    <script type="text/javascript" src="/static/js/jquery.imagezoom.min.js"></script>
    <script type="text/javascript" src="/static/js/jquery.flexslider.js"></script>
    <script type="text/javascript" src="/static/js/list.js"></script>

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
                <div class="menu-hd"><a href="<?php echo url('index/index/index'); ?>" target="_top" class="h">商城首页</a></div>
            </div>
            <div class="topMessage my-shangcheng">
                <div class="menu-hd MyShangcheng"><a href="<?php echo url('index/person/center'); ?>" target="_top"><i
                        class="am-icon-user am-icon-fw"></i>个人中心</a></div>
            </div>
            <div class="topMessage mini-cart">
                <div class="menu-hd"><a id="mc-menu-hd" href="<?php echo url('index/goods/shopcar'); ?>" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i>
                    <span>购物车</span><strong id="J_MiniCartNum" class="h"><?php echo $sumcar; ?></strong></a></div>
            </div>
            <div class="topMessage favorite">
                <div class="menu-hd"><a href="<?php echo url('index/person/collection'); ?>" target="_top"><i
                        class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a></div>
       </div>
        </ul>
    </div>

    <!--悬浮搜索框-->

    <div class="nav white">
        <div class="logo"><img src="/static/images/FooD.png"/></div>
        <div class="logoBig">
            <li><img style="height: 100px;width: 100px" src="/static/images/FooD.png"/></li>
        </div>

        <div class="search-bar pr">
            <a name="index_none_header_sysc" href="#"></a>
            <form action="<?php echo url('index/search/searchs'); ?>" method="post">
                <input id="searchInput" name="keys" type="text" placeholder="搜索" autocomplete="off">
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
            <h1>店铺名称：</h1><br>
            <h1 style="font-size: 36px"><?php echo $data['name']; ?></h1>
        </ol>
        <script type="text/javascript">
            $(function () {
            });
            $(window).load(function () {
                $('.flexslider').flexslider({
                    animation: "slide",
                    start: function (slider) {
                        $('body').removeClass('loading');
                    }
                });
            });
        </script>


        <!--优惠套装-->
        <div class="match">
            <div class="match-title">菜品</div>
            <div class="match-comment">
                <ul class="like_list">


                    <!--优惠套装-->
                    <div class="match">

                        <div class="match-comment">
                            <ul class="like_list" style="display: flex;flex-wrap: wrap">


                                <?php if(is_array($recommend3) || $recommend3 instanceof \think\Collection || $recommend3 instanceof \think\Paginator): $i = 0; $__LIST__ = $recommend3;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
                                <li style="display: flex;align-items: center;margin: 0;padding: .25em;flex: 25%;max-width: 25%; box-sizing: border-box">
                                    <div style="margin: .15em;">
                                        <div class="s_picBox">
                                            <a class="s_pic"
                                               href="<?php echo url('index/goods/introduction'); ?>?id=<?php echo $value['goods_id']; ?>"><img
                                                    src="<?php echo $value['imgpath']; ?>"></a>
                                        </div>
                                        <a class="txt" target="_blank" href="#"><?php echo $value['good_name']; ?></a>
                                        <div class="info-box"><span class="info-box-price"><?php echo $value['price']; ?></span> <span
                                                class="info-original-price"><?php echo $value['market']; ?></span></div>
                                    </div>
                                    <div class="total_price" style="margin: 0 .5em">
                                        <p class="combo_price"><span
                                                class="c-title">促销价:</span><span><?php echo $value['price']; ?></span></p>
                                        <p class="save_all">共省:<span><?php echo $value['market']-$value['price']; ?></span></p> <a
                                            href="<?php echo url('index/orders/pay'); ?>?id=<?php echo $value['goods_id']; ?>"
                                            class="buy_now">立即下单</a></div>
<!--                                    <div class="plus_icon" style="margin-right: 20px;"><i-->
<!--                                            class="am-icon-angle-right"></i></div>-->
                                </li>
                                <?php endforeach; endif; else: echo "" ;endif; ?>


                            </ul>
                        </div>
                    </div>


                </ul>
            </div>
        </div>
        <div class="clear"></div>



</div>
</div>
</body>

</html>