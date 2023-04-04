<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:71:"D:\PHP\wamp64\www\FooD\public/../application/index\view\orders\pay.html";i:1620806097;s:81:"D:\PHP\wamp64\www\FooD\application\index\view\common\form_address_addDefault.html";i:1620806095;s:75:"D:\PHP\wamp64\www\FooD\application\index\view\common\form_address_edit.html";i:1620806095;s:69:"D:\PHP\wamp64\www\FooD\application\index\view\common\modal_alert.html";i:1620806095;}*/ ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport"
      content="width=device-width, initial-scale=1.0 ,minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>结算页面</title>
<link href="/static/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css"/>
<link href="/static/basic/css/demo.css" rel="stylesheet" type="text/css"/>
<link href="/static/css/cartstyle.css" rel="stylesheet" type="text/css"/>
<link href="/static/css/jsstyle.css" rel="stylesheet" type="text/css"/>
<script src="/static/AmazeUI-2.4.2/assets/js/jquery.min.js"></script>
<script src="/static/AmazeUI-2.4.2/assets/js/amazeui.js"></script>
<script src="/static/distpicker-2.0.6/dist/distpicker.min.js"></script>
<!--	<script type="text/javascript" src="/static/js/address.js"></script>-->
<style>
    .item-content li.td {
        display: block;
        position: unset !important;
        width: auto
    }

    .item-content li.td-price {
        width: 10%;
        padding-left: 2em;
        margin-top: 20px;
    }

    .item-content li.td-number {
        margin: 20px auto 0;
    }

    .item-content li.td-oplist {
        width: 10%;
        margin: 20px auto 0;
    }

    .pay-list {
        display: flex
    }

    .pay-list li.pay {
        float: unset;
        width: unset;
        padding: .5em;
        margin-top: 1em;
        margin-bottom: 1em;
    }

    .pay-list li + li {
        margin-left: 2em
    }

    li[data-payway].active {
        border: 1px solid red;
    }

    .user-addresslist{margin-bottom: 1em}

    li.user-addresslist{cursor: pointer}
</style>
</head>

<body>

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
            <div class="menu-hd MyShangcheng"><a href="<?php echo url('index/person/center'); ?>" target="_top">
                <i class="am-icon-user am-icon-fw"></i>个人中心</a></div>
        </div>
        <div class="topMessage mini-cart">
            <div class="menu-hd"><a id="mc-menu-hd" href="<?php echo url('index/goods/shopcar'); ?>" target="_top">
                <i class="am-icon-shopping-cart  am-icon-fw"></i>
                <span>购物车</span><?php echo $sumcar; ?><strong id="J_MiniCartNum" class="h"></strong></a></div>
        </div>
        <div class="topMessage favorite">
            <div class="menu-hd"><a href="<?php echo url('index/person/collection'); ?>" target="_top"><i
                    class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a></div>
        </div>
    </div>
</div>
<!--悬浮搜索框-->

<div class="nav white">
    <div class="logo"><img  src="/static/images/FooD.png"/></div>
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

<div class="concent">
    <!--地址 -->
    <div class="paycont">
        <div class="address">
            <h3>确认收货地址 </h3>

            <div class="control">
                <a href="javascript:;" class="tc-btn createAddr theme-login am-btn am-btn-danger"
                   data-am-modal="{target: '#doc-modal-1'}">新增地址</a>
            </div>

            <div class="clear"></div>
            <ul>
                <li class="user-addresslist defaultAddr" data-address-id="<?php echo $address['address_id']; ?>">
                    <div class="per-border"></div>
                    <div class="address-left">
                        <div class="user DefaultAddr">
                            <span class="buy-address-detail">
                                <span class="buy-user"><?php echo $address["consignee"]; ?></span>
                                <span class="buy-phone"><?php echo $address["phone"]; ?></span>
                            </span>
                        </div>
                        <br>
                        <div class="default-address DefaultAddr">
                            <span class="buy-line-title buy-line-title-type">收货地址：</span>
                            <span class="buy--address-detail"><?php echo $address["address_info"]; ?></span>
                        </div>
                        <ins class="deftip">默认地址</ins>
                    </div>
                    <div class="address-right">
                        <a href="person/address.html">
                            <span class="am-icon-angle-right am-icon-lg"></span></a>
                    </div>
                    <div class="clear"></div>
                    <div class="new-addr-btn">
                        <a href="#" class="hidden">设为默认</a>
                        <span class="new-addr-bar hidden">|</span>
                        <a href="javascript:;" data-am-modal="{target: '#doc-modal-2'}" data-edit-address-id="<?php echo $address['address_id']; ?>">编辑</a>
                        <span class="new-addr-bar">|</span>
                    </div>
                    <div class="per-border"></div>
                </li>

                <?php if(is_array($address_list) || $address_list instanceof \think\Collection || $address_list instanceof \think\Paginator): $k = 0; $__LIST__ = $address_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cur_ad): $mod = ($k % 2 );++$k;if($key != 0): ?>
                    <li class="user-addresslist" data-address-id="<?php echo $cur_ad['address_id']; ?>">
                        <div class="per-border"></div>
                        <div class="address-left">
                            <div class="user DefaultAddr">
                                <span class="buy-address-detail">
                                    <span class="buy-user"><?php echo $cur_ad["consignee"]; ?></span>
                                    <span class="buy-phone"><?php echo $cur_ad["phone"]; ?></span>
                                </span>
                            </div>
                            <br>
                            <div class="default-address DefaultAddr">
                                <span class="buy-line-title buy-line-title-type">收货地址：</span>
                                <span class="buy--address-detail"><?php echo $cur_ad["address_info"]; ?></span>
                            </div>
                            <?php if($cur_ad['is_default'] == 1): ?>
                            <ins class="deftip">默认地址</ins>
                            <?php endif; ?>
                        </div>
                        <div class="address-right">
                            <a href="person/address.html">
                                <span class="am-icon-angle-right am-icon-lg"></span></a>
                        </div>
                        <div class="clear"></div>
                        <div class="new-addr-btn">
                            <a href="#" class="hidden">设为默认</a>
                            <span class="new-addr-bar hidden">|</span>
                            <a href="javascript:;" data-am-modal="{target: '#doc-modal-2'}" data-edit-address-id="<?php echo $cur_ad['address_id']; ?>">编辑</a>
                            <span class="new-addr-bar">|</span>
                        </div>
                        <div class="per-border"></div>
                    </li>
                    <?php endif; endforeach; endif; else: echo "" ;endif; ?>
            </ul>

            <div class="clear"></div>
        </div>

        <!--物流 -->
        <!--	<div class="logistics">
                <h3>选择物流方式</h3>
                <ul class="op_express_delivery_hot">
                    <li data-value="yuantong" class="OP_LOG_BTN  "><i class="c-gap-right" style="background-position:0px -468px"></i>圆通<span></span></li>
                    <li data-value="shentong" class="OP_LOG_BTN  "><i class="c-gap-right" style="background-position:0px -1008px"></i>申通<span></span></li>
                    <li data-value="yunda" class="OP_LOG_BTN  "><i class="c-gap-right" style="background-position:0px -576px"></i>韵达<span></span></li>
                    <li data-value="zhongtong" class="OP_LOG_BTN op_express_delivery_hot_last "><i class="c-gap-right" style="background-position:0px -324px"></i>中通<span></span></li>
                    <li data-value="shunfeng" class="OP_LOG_BTN  op_express_delivery_hot_bottom"><i class="c-gap-right" style="background-position:0px -180px"></i>顺丰<span></span></li>
                </ul>
            </div>-->
        <div class="clear"></div>

        <!--订单 -->
        <div class="concent">
            <div id="payTable">
                <h3>确认订单信息</h3>
                <div class="cart-table-th">
                    <div class="wp">

                        <div class="th th-item">
                            <div class="td-inner">商品信息</div>
                        </div>
                        <div class="th th-price">
                            <div class="td-inner">单价</div>
                        </div>
                        <div class="th th-amount">
                            <div class="td-inner">数量</div>
                        </div>

                        <div class="th th-oplist">
                            <div class="td-inner">配送方式</div>
                        </div>

                    </div>
                </div>
                <div class="clear"></div>


                <form action="<?php echo url('index/orders/gopay'); ?>" method="post">

                    <div class="bundle  bundle-last">
                        <div class="bundle-main" style="position: relative;" id="tab">
                            <input type="hidden" name="is_multi" value="<?php echo $is_multi; ?>"/>
                            <?php if($is_multi == 0): ?>
                            <ul class="item-content clearfix">
                                <li class="td td-item" style="width: 50%">
                                    <div class="item-pic">
                                        <a href="#" class="J_MakePoint">
                                            <img src="<?php echo $goodsInfo['imgpath']; ?>" class="itempic J_ItemImg" width="85px"></a>
                                    </div>
                                    <div class="item-info">
                                        <div class="item-basic-info">
                                            <a href="#" class="item-title J_MakePoint" data-point="tbcart.8.11"><?php echo $goodsInfo['good_name']; ?></a>
                                        </div>
                                    </div>
                                </li>
                                <li class="td td-price">
                                    <div class="item-props">
                                        <span class="price" style="color: red;font-size: 18px;display: block;"><?php echo $goodsInfo['price']; ?></span>
                                    </div>
                                </li>

                                <li class="td td-number">
                                    <input class="min" name="" type="button" value="-"/>
                                    <input class="text_box" name="goodssum" type="text" value="<?php echo $goodssum; ?>"
                                           style="width: 80px;"/>
                                    <input type="hidden" name="id" value="<?php echo $goodsInfo['goods_id']; ?>"/>

                                    <input class="adds" name="" type="button" value="+"/>
                                </li>

                                <li class="td td-oplist">
                                    <div class="td-inner">
                                        <span class="phone-title">配送方式</span>
                                        <div class="pay-logis">
                                            <span>包邮</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <?php endif; if($is_multi == 1): if(is_array($goodsInfo) || $goodsInfo instanceof \think\Collection || $goodsInfo instanceof \think\Paginator): $i = 0; $__LIST__ = $goodsInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>

                            <ul class="item-content clearfix">
                                <li class="td td-item" style="width: 50%">
                                    <div class="item-pic">
                                        <a href="#" class="J_MakePoint">
                                            <img src="<?php echo $item['imgpath']; ?>" class="itempic J_ItemImg" width="85px"></a>
                                    </div>
                                    <div class="item-info">
                                        <div class="item-basic-info">
                                            <a href="#" class="item-title J_MakePoint" data-point="tbcart.8.11"><?php echo $item['good_name']; ?></a>
                                        </div>
                                    </div>
                                </li>
                                <li class="td td-price">
                                    <div class="item-props">
                                        <span class="price" style="color: red;font-size: 18px;display: block;"><?php echo $item['price']; ?></span>
                                    </div>
                                </li>

                                <li class="td td-number">
                                    <input class="min" name="" type="button" value="-"/>
                                    <input class="text_box" name="goodssum[]" type="text" value="<?php echo $goodssum[$key]; ?>"
                                           style="width: 80px;"/>
                                    <input type="hidden" name="id[]" value="<?php echo $item['goods_id']; ?>"/>
                                    <input class="adds" name="" type="button" value="+"/>
                                </li>


                                <li class="td td-oplist">
                                    <div class="td-inner">
                                        <span class="phone-title">配送方式</span>
                                        <div class="pay-logis">
                                            <span>包邮</span>
                                        </div>
                                    </div>
                                </li>

                            </ul>

                            <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                        </div>
                    </div>


                    <!--留言-->
                    <div class="order-extra">
                        <div class="order-user-info">
                            <div id="holyshit257" class="memo">
                                <label>买家留言：</label>
                                <input name="message" type="text" title="选填,对本次交易的说明（建议填写已经和卖家达成一致的说明）"
                                       placeholder="选填,建议填写和卖家达成一致的说明"
                                       class="memo-input J_MakePoint c2c-text-default memo-close">
                                <div class="msg hidden J-msg">
                                    <p class="error">最多输入500个字符</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--优惠券 -->

                    <!--含运费小计 -->
                    <div class="clear"></div>
                    <!--支付方式-->
                    <div class="logistics">
                        <h3>选择支付方式</h3>
                        <ul class="pay-list">
                            <li class="pay card" data-payway="cardpay">
                                <img src="/static/images/wangyin.jpg"/>
                                <span>银联</span>
                            </li>
                            <li class="pay qq" data-payway="weixinpay">
                                <img src="/static/images/weizhifu.jpg"/>
                                <span>微信</span>
                            </li>
                            <li class="pay taobao" data-payway="alipay">
                                <img src="/static/images/zhifubao.jpg"/>
                                <span>支付宝</span>
                            </li>
                        </ul>
                        <input type="hidden" name="payway" value="default">

                    </div>
                    <div class="clear"></div>
                    <!--信息 -->
                    <div class="order-go clearfix">
                        <div class="pay-confirm clearfix">
                            <div class="box">
                                <div tabindex="0" id="holyshit267" class="realPay"><em class="t">实付款：</em>
                                    <span class="price g_price ">
							            <span>¥</span>
                                        <em class="style-large-bold-red " id="J_ActualFee">
									        <label id="total" class="style-large-bold-red "></label>
								        </em>
                                    </span>
                                </div>

                                <div id="holyshit268" class="pay-address">
                                    <input type="hidden" name="order_addID" value="<?php echo $address['address_id']; ?>">
                                    <p class="buy-footer-address">
                                        <span class="buy-line-title buy-line-title-type">寄送至：</span>
                                        <span class="buy--address-detail"><?php echo $address["address_info"]; ?></span>
                                    </p>

                                    <p class="buy-footer-address">
                                        <span class="buy-line-title">收货人：</span>
                                        <span class="buy-address-detail">
                                            <span class="buy-user"><?php echo $address["consignee"]; ?> </span>
                                            <span class="buy-phone"><?php echo $address["phone"]; ?></span>
                                        </span>
                                    </p>

                                </div>
                            </div>

                            <div id="holyshit269" class="submitOrder">
                                <div class="go-btn-wrap" style="position: relative;">

                                    <button class="btn-go" tabindex="0" title="点击此按钮，提交订单"
                                            style="display: block;float:right; border:none"
                                            onclick="if(confirm('请检查你要购买的商品信息是否正确')==false)return false;">提交订单
                                    </button>

                                    <a href="javascript:;" id="cancel_order" class="btn-go"
                                       onclick="if(confirm('确定要取消当前的订单吗？')==false)return false;"
                                       style="background-color: #888;margin-right: 1em"
                                       tabindex="0" title="取消订单">取消订单</a>

                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>


            </form>

            </div>
            <div class="clear"></div>
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
</div>

<?php $isPopover=true; ?>
<div class="am-modal am-modal-no-btn" tabindex="-1" id="doc-modal-1" style="background-color: #fff">
    <div class="am-modal-dialog">
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
				<!--<small style="color: #aaa"></small>-->
			</div>
		</div>

		<div class="am-form-group theme-poptit">
			<div class="am-u-sm-9 am-u-sm-push-3"style="position: relative;left:50px;">
				<a href="javascript:;" id="add-address-submit" class="am-btn am-btn-danger" >确定</a>
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
					url: "<?php echo url('index/person/newDefault'); ?>",
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
</div>

<div class="am-modal am-modal-no-btn" tabindex="-1" id="doc-modal-2" style="background-color: #fff">
    <div class="am-modal-dialog">
        <!--标题 -->
<div class="am-cf am-padding">
	<div class="am-modal-hd am-fl am-cf">
		<strong class="am-text-danger am-text-lg">修改地址</strong> / <small>Update&nbsp;address</small>
	</div>
</div>
<hr/>

<div class="am-u-md-12 am-modal-bd" style="max-width: 600px;border-bottom: none">
	<form class="am-form am-form-horizontal" id="form-address-edit">
		<input type="hidden" name="addressid" value="<?php echo $address['address_id']; ?>" />
		<div class="am-form-group">
			<label for="user-name" class="am-form-label">收货人</label>
			<div class="am-form-content">
				<input type="text" name="consignee" placeholder="收货人" value="<?php echo $address['consignee']; ?>">
			</div>
		</div>

		<div class="am-form-group">
			<label for="user-phone" class="am-form-label">手机号码</label>
			<div class="am-form-content">
				<input name="phone" placeholder="手机号必填" type="text" value="<?php echo $address['phone']; ?>">
			</div>
		</div>
		<div class="am-form-group">
			<label for="user-address" class="am-form-label">所在地</label>
			<div id="distpicker-edit" class="am-form-content address" style="display: flex">
				<select name="province" data-province="<?php echo $address['prov']; ?>"></select>
				<select name="city" data-city="<?php echo $address['city']; ?>"></select>
				<select name="district" data-district="<?php echo $address['district']; ?>"></select>
			</div>
		</div>

		<div class="am-form-group">
			<label for="user-intro" class="am-form-label">详细地址</label>
			<div class="am-form-content" style="
    display: flex;
    flex-direction: column;
    align-items: flex-start;
">
				<textarea name="address" rows="3" id="user-intro"><?php echo $address['address_detail']; ?></textarea>
				<small style="color: #aaa">100字以内写出你的详细地址...</small>
			</div>
		</div>

		<div class="am-form-group">
			<a href="javascript:;" id="edit-address-submit" class="am-btn am-btn-danger">确认修改</a>
			<?php if(!(empty($isPopover) || (($isPopover instanceof \think\Collection || $isPopover instanceof \think\Paginator ) && $isPopover->isEmpty()))): ?>
			<div class="am-btn am-btn-danger close" data-am-modal-close>取消</div>
			<?php endif; ?>
		</div>
	</form>
</div>

<script>
	$(function(){
		let dpEdit   = $('#distpicker-edit').distpicker('reset'),
			my_alert = $('#doc-modal-alert');

		$('#edit-address-submit').on('click', function(){
			$.ajax({
				type: "POST",
				url: "<?php echo url('index/person/updateAd'); ?>",
				dataType: "json",
				data: $('#form-address-edit').serialize(),
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

<div class="am-modal am-modal-alert" tabindex="-1" id="doc-modal-alert">
    <div class="am-modal-dialog">
        <div class="am-modal-hd">提示</div>
        <div class="am-modal-bd" id="doc-modal-alert-info"></div>
        <div class="am-modal-footer">
            <span class="am-modal-btn">确定</span>
        </div>
    </div>
</div>

<div class="clear"></div>

</body>
<script>
    $(function () {
        // 更改商品数量
        function setTotal() {
            var s = 0;
            $("#tab ul").each(function (index, elem) {
                let cur_num = $(elem).find('input.text_box').val(),
                    cur_price = $(elem).find('span.price').text()
                s += cur_num * cur_price;
            });
            $("#total").html(s.toFixed(2));
        }
        setTotal();

        $(".adds").click(function () {
            var t = $(this).parent().find('input[class*=text_box]');
            t.val(parseInt(t.val()) + 1)
            setTotal();
        })
        $(".min").click(function () {
            var t = $(this).parent().find('input[class*=text_box]');
            t.val(parseInt(t.val()) - 1)
            if (parseInt(t.val()) < 1) {
                t.val(1);
            }
            setTotal();
        })

        // 选择收货地址
        let elem_cur_active, ele_finnal_address, cur_addID,
            elems_li_address = $('.concent .address li.user-addresslist')
        $(document).on('click', '.concent .address li', function (e){
            elems_li_address.removeClass('defaultAddr')
            $(e.currentTarget).addClass('defaultAddr')

            cur_addID = parseInt($(e.currentTarget).data('address-id'))

            elem_cur_active = $('li[data-address-id="' + cur_addID + '"]')
            ele_finnal_address = $('#holyshit268')

            $('#holyshit268 .buy--address-detail').text(elem_cur_active.find('.buy--address-detail').text())
            $('#holyshit268 .buy-user').text(elem_cur_active.find('.buy-user').text())
            $('#holyshit268 .buy-phone').text(elem_cur_active.find('.buy-phone').text())
            $('#holyshit268 input[name="order_addID"]').val(cur_addID)
        })

        // 提交订单
        $(document).on('click', 'li[data-payway]', function (e) {
            let elem_active_payway = $('input[name="payway"]'),
                elem_cur_click = $(e.currentTarget)

            if (elem_active_payway.val() === 'defualt') {
                elem_cur_click.addClass('active')
                elem_active_payway.val(elem_cur_click.data('payway'))
            } else {
                if (elem_active_payway.val() === elem_cur_click.data('payway')) {
                    elem_cur_click.removeClass('active')
                    elem_active_payway.val('default')
                } else {
                    $('li[data-payway].active').removeClass('active')
                    elem_cur_click.addClass('active')
                    elem_active_payway.val(elem_cur_click.data('payway'))
                }
            }
        })

        // 取消订单
        $(document).on('click', '#cancel_order', function (e){
            let am_alert = $('#doc-modal-alert');
            $.ajax({
                type: "POST",
                url: "<?php echo url('index/orders/gopay'); ?>?action=cancel_order",
                dataType: "json",
                data: $('#payTable form').serialize(),
                success: function(data){
                    if(!am_alert.length){
                        alert(data.msg)
                    }
                    setTimeout(function () {
                        history.back();
                    },2000)
                }
            })
        })
    })
</script>

</html>