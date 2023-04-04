<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:76:"D:\PHP\wamp64\www\FooD\public/../application/index\view\orders\successs.html";i:1620806097;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>付款成功页面</title>
    <link rel="stylesheet" type="text/css" href="/static/AmazeUI-2.4.2/assets/css/amazeui.css"/>
    <link href="/static/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
    <link href="/static/basic/css/demo.css" rel="stylesheet" type="text/css"/>

    <link href="/static/css/sustyle.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="/static/basic/js/jquery-1.7.min.js"></script>
    <script type="text/javascript" src="//api.map.baidu.com/api?type=webgl&v=1.0&ak=mRL5q1Hsb0hoghe1GoKFmQFXK7SZCgnY"></script>

    <style>
        #container {width: 100%;height: 100%;overflow: hidden;margin:0;font-family:"微软雅黑";}
    </style>
</head>

<body>


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
            <div class="menu-hd MyShangcheng"><a href="<?php echo url('index/person/center'); ?>" target="_top"><i
                    class="am-icon-user am-icon-fw"></i>个人中心</a></div>
        </div>
        <div class="topMessage mini-cart">
            <div class="menu-hd"><a id="mc-menu-hd" href="<?php echo url('index/goods/shopcar'); ?>" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i>
                <span>购物车</span><strong id="J_MiniCartNum" class="h"><?php echo $sumcar; ?></strong></a></div>
        </div>
        <div class="topMessage favorite">
            <div class="menu-hd">
                <a href="<?php echo url('index/person/collection'); ?>" target="_top">
                <i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span>
                </a>
            </div>
        </div>
    </ul>
</div>

<!--悬浮搜索框-->

<div class="nav white">
    <div class="logo"><img src="/static/images/FooD.png"/></div>
    <div class="logoBig">
        <li><img style="height: 100px;width: 100px"; src="/static/images/FooD.png"/></li>
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


<div class="take-delivery">
    <div class="content" style="display: flex">
        <div class="order-info">
            <h2>您已成功付款</h2>
            <div class="successInfo">
                <ul>
                    <li>订单编号<em><?php echo $order_num; ?></em></li>
                    <li>付款金额<em>¥<?php echo $money; ?></em></li>
                    <div class="user-info">
                        <p>收货人：<?php echo $address['consignee']; ?></p>
                        <p>联系电话：<?php echo $address['phone']; ?></p>
                        <p>收货地址：<?php echo $address['address_info']; ?></p>
                    </div>
                    请认真核对您的收货信息，如有错误请联系客服

                </ul>
                <div class="option">
                    <span class="info">您可以</span>
                    <a href="<?php echo url('index/person/order'); ?>" class="J_MakePoint">查看<span>已买到的宝贝</span></a>
                    <a href="<?php echo url('index/person/order'); ?>" class="J_MakePoint">查看<span>交易详情</span></a>
                </div>
            </div>
        </div>

        <div class="delivery-status" style="display: flex;flex: 1">

            <div class="raider-info" style="margin-right: 1em;">
                <h2 style="font-size: 1.25em;line-height: 1.5;height:auto">骑手正在赶往商家...</h2>
                <h2 style="font-size: 1.25em;line-height: 1.5;height:auto">预计 <?php echo $arrival_time; ?> 到达</h2>

                <div style="line-height: 1.5;margin-top: 2em">
                    <p>骑手编号： E<?php echo substr(lcg_value(), 2, -1) ?></p>
                    <p>骑手电话： 1<?php echo substr(lcg_value(), 2, 10) ?></p>
                    <p>骑手体温： 36.<?php echo rand(0,9)?> ℃</p>
                </div>

            </div>

            <div style="width: 100%;height: 100%">
                <div id='container' style="width: 100%;height: 100%"></div>
            </div>
        </div>

    </div>
</div>


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

<script>
    $(function (){
        let map = new BMapGL.Map("container", { enableMapClick: false }),
            center_address = '<?php echo $address['address_info']; ?>'.split(' ')[0]

        map.centerAndZoom(center_address, 14);

        // console.log(map.getCenter().lng.toFixed(5))
        setTimeout(function (){
            let cent = map.getCenter(),rid_start,rid_end,
                start_p = randLocalPoint(cent.lng, cent.lat),
                end_p = randLocalPoint(cent.lng, cent.lat)

            var riding = new BMapGL.RidingRoute(map, {
                renderOptions: {
                    map: map,
                    autoViewport: true
                }
            });

            rid_start = new BMapGL.Point(start_p.lng, start_p.lat);
            rid_end = new BMapGL.Point(end_p.lng, end_p.lat, .1);

            riding.search(rid_start, rid_end);
        }, 2000)

        function getMapCenter() {
            var cen = map.getCenter(); // 获取地图中心点
            alert('地图中心点: (' + cen.lng.toFixed(5) + ', ' + cen.lat.toFixed(5) + ')');
        }

        function randLocalPoint(lng, lat, fit=1) {
            rand_lng = lng + Math.floor((Math.random() - Math.random()) * 389 / fit) / 1e3
            rand_lat = lat + Math.floor((Math.random() - Math.random()) * 114 / fit) / 1e3
            return {
                'lng': rand_lng,
                'lat': rand_lat
            }
        }
    })
</script>
</body>
</html>