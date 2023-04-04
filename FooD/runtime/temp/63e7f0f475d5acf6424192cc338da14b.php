<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:74:"D:\PHP\wamp64\www\FooD\public/../application/index\view\goods\shopcar.html";i:1620806096;}*/ ?>
<!DOCTYPE html>
<html >

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>购物车页面</title>

    <link href="/static/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css"/>
    <link href="/static/basic/css/demo.css" rel="stylesheet" type="text/css"/>
    <link href="/static/css/cartstyle.css" rel="stylesheet" type="text/css"/>
    <link href="/static/css/optstyle.css" rel="stylesheet" type="text/css"/>

    <script type="text/javascript" src="/static/js/jquery.js"></script>
</head>
<div>

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
                <div class="menu-hd MyShangcheng">
                    <a href="<?php echo url('index/person/center'); ?>" target="_top">
                        <i class="am-icon-user am-icon-fw"></i>个人中心</a></div>
            </div>
            <div class="topMessage mini-cart">
                <div class="menu-hd"><a id="mc-menu-hd" href="<?php echo url('index/goods/shopcar'); ?>" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i>
                    <span>购物车</span><strong id="J_MiniCartNum" class="h"><?php echo $sumcar; ?></strong></a></div>
            </div>
            <div class="topMessage favorite">
                <div class="menu-hd"><a href="<?php echo url('index/person/collection'); ?>" target="_top"><i
                        class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a></div>
            </div>
        </div>
    </div>


    <!--悬浮搜索框-->

    <div class="nav white">
        <div class="logo"><img src="/static/images/FooD.png"/></div>
        <div class="logoBig">
            <li><img style="height: 90px;width: 90px" src="/static/images/FooD.png"/></li>
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

    <!--购物车 -->
    <div class="concent">
        <div id="cartTable">
            <div class="cart-table-th">
                <div class="wp">
                    <div class="th th-chk">
                        <div id="J_SelectAll1" class="select-all J_SelectAll">

                        </div>
                    </div>
                    <div class="th th-item">
                        <div class="td-inner">商品信息</div>
                    </div>
                    <div class="th th-price">
                        <div class="td-inner">单价</div>
                    </div>
                    <div class="th th-amount">
                        <div class="td-inner">数量</div>
                    </div>
                    <div class="th th-sum">
                        <div class="td-inner">金额</div>
                    </div>
                    <div class="th th-op">
                        <div class="td-inner">操作</div>
                    </div>
                </div>
            </div>
            <div class="clear"></div>

            <tr class="item-list">
                <div class="bundle  bundle-last ">
                    <div class="bundle-hd">
                        <input class="check" id="sc-select-all" type="checkbox" style="float: left;margin: 5px 10px 0">
                        <div class="bd-promos" style="margin-left: 0">
                            <div class="bd-has-promo">
                                <?php if(empty($cart)): ?>
                                购物车空空如也，赶紧去购物吧
                                <?php else: ?>
                                我的购物车
                                <?php endif; ?>
                            </div>
                            <div class="act-promo">

                            </div>
                            <span class="list-change theme-login">编辑</span>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="bundle-main">
                        <form action="<?php echo url('index/orders/pay'); ?>" method="post" 　id="J_shopcar">
                            <?php if(is_array($cart) || $cart instanceof \think\Collection || $cart instanceof \think\Paginator): $k = 0; $__LIST__ = $cart;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($k % 2 );++$k;?>
                            <div class="shop-title" data-merchant-id="<?php echo $value['merchant_id']; ?>" style="padding: .5em;line-height: 1.5;background: #fafafa"><?php echo $value['name']; ?></div>
                            <ul class="item-content clearfix">
                                <li class="td td-chk">
                                    <div class="cart-checkbox">
                                        <input class="check" type="checkbox" data-goods-id="<?php echo $value['goods_id']; ?>">
                                        <input type="hidden" name="goods_id[]">
                                    </div>
                                </li>
                                <li class="td td-item">
                                    <div class="item-pic">
                                        <a href="<?php echo url('index/goods/introduction'); ?>?id=<?php echo $value['goods_id']; ?>" target="_blank" class="J_MakePoint">
                                            <img src="<?php echo $value['imgpath']; ?>" class="itempic J_ItemImg" width="85px;"></a>
                                    </div>
                                    <div class="item-info">
                                        <div class="item-basic-info">
                                            <a href="<?php echo url('index/goods/introduction'); ?>?id=<?php echo $value['goods_id']; ?>" target="_blank" title="<?php echo $value['good_name']; ?>"
                                               class="item-title J_MakePoint"><?php echo $value['good_name']; ?></a>
                                        </div>
                                    </div>
                                </li>
                                <li class="td td-price" style="margin-left: auto">
                                    <div class="item-price price-promo-promo">
                                        <div class="price-content">
                                            <div class="price-line">
                                                <em class="price-original"><?php echo $value['market']; ?></em>
                                            </div>
                                            <div class="price-line">
                                                <em class="J_Price price-now" style="color: red;"><?php echo $value['price']; ?></em>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="td td-amount">
                                    <div class="amount-wrapper ">
                                        <div class="item-amount ">
                                            <div class="sl">
                                                <input class="min am-btn" type="button" value="-"/>
                                                <input class="text_box" name="goods_num[]" type="text" min="1" value="<?php echo $session_car[$value['goods_id']]; ?>"
                                                       style="width:30px;"/>
                                                <input class="add am-btn" type="button" value="+"/>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="td td-sum">
                                    <div class="td-inner">
                                        <em tabindex="0" class="J_ItemSum number"><?php echo $value['price']; ?></em>
                                    </div>
                                </li>
                                <li class="td td-op">
                                    <div class="td-inner">
                                        <a title="移入收藏夹" class="btn-fav"
                                           href="<?php echo url('index/person/moveCollect'); ?>?id=<?php echo $value['goods_id']; ?>">
                                            移入收藏夹</a>
                                        <a href="<?php echo url('index/goods/delCart'); ?>?id=<?php echo $value['goods_id']; ?>"
                                           onclick="if(confirm('你确定要删除此商品吗？')==false)return false;"
                                           data-point-url="#" class="delete">删除</a>
                                    </div>
                                </li>
                            </ul>
                            <?php endforeach; endif; else: echo "" ;endif; ?>

                            <script>
                                $(function () {
                                    let status_sc_selectAll = false,
                                        elem_sc_selectAll = $('#sc-select-all'),
                                        elems_sc_checkbox = $('.item-content .td-chk input[type="checkbox"]'),
                                        elems_sc_checked = $('.item-content .td-chk input[checked]')

                                    function set_goods_sum() {
                                        elems_sc_checked = $('.item-content .td-chk input[checked]')
                                        let goods_count = 0, price_sum = 0, cur_sum, cur_num, cur_price
                                            elem_cur_parent = ''

                                        elems_sc_checkbox.each(function (index, item) {
                                            elem_cur_parent = $(item).parents('.item-content')
                                            if (item.hasAttribute('checked')) {
                                                elem_cur_parent.find('[type="hidden"]').attr('value', $(item).data('goods-id'))
                                                cur_price = parseFloat(elem_cur_parent.find('.J_Price.price-now').text())
                                                cur_num = parseInt(elem_cur_parent.find('.td-amount .sl .text_box').val())
                                                cur_sum = cur_price * cur_num
                                                elem_cur_parent.find('.J_ItemSum.number').text(cur_sum.toFixed(2))

                                                goods_count += cur_num
                                                price_sum += parseFloat(elem_cur_parent.find('.td-sum .J_ItemSum.number').text())
                                            } else {
                                                elem_cur_parent.find('[type="hidden"]').removeAttr('value')
                                            }
                                        })
                                        $('#J_SelectedItemsCount').text(goods_count)
                                        $('#J_Total').text(price_sum.toFixed(2))
                                    }

                                    function upload_shopcar_info(){
                                        let elem_ul_item = $('ul.item-content'),
                                            a_data = []

                                        elem_ul_item.each(function (index, item){
                                            a_data.push({
                                                'id': $(item).find('input[data-goods-id]').data('goods-id'),
                                                'num': $(item).find('input.text_box').val(),
                                            })
                                        })
                                        $.ajax({
                                            type: "POST",
                                            url: "<?php echo url('index/goods/editcar'); ?>",
                                            dataType : "json",
                                            data: {'data': a_data}
                                        })
                                    }

                                    $(document).on('click', '.item-content .td-amount .sl input[type="button"]', function (e) {
                                        upload_shopcar_info()
                                        set_goods_sum()
                                    })

                                    $(document).on('click', '#sc-select-all', function () {
                                        elems_sc_checkbox = $('.item-content .td-chk input[type="checkbox"]')
                                        if (!status_sc_selectAll) {
                                            if (elems_sc_checkbox.length) {
                                                elems_sc_checkbox.attr('checked', '')
                                                status_sc_selectAll = true
                                            }
                                        } else {
                                            elems_sc_checkbox.removeAttr('checked')
                                            status_sc_selectAll = false
                                        }
                                        set_goods_sum()
                                    })

                                    $(document).on('click', '.bundle-main .item-content input[type="checkbox"]', function (e) {
                                        elems_sc_checkbox = $('.item-content .td-chk input[type="checkbox"]')
                                        if (e.target.hasAttribute('checked')) {
                                            $(e.target).removeAttr('checked')
                                        } else {
                                            $(e.target).attr('checked', '')
                                        }
                                        elems_sc_checked = $('.item-content .td-chk input[checked]')
                                        if (elems_sc_checkbox.length === elems_sc_checked.length) {
                                            status_sc_selectAll = true
                                            elem_sc_selectAll.attr('checked', '')
                                        } else {
                                            status_sc_selectAll = false
                                            elem_sc_selectAll.removeAttr('checked')
                                        }
                                        set_goods_sum()
                                    })

                                    $(document).on('click', '#J_Go', function () {
                                        elems_sc_checked = $('.item-content .td-chk input[checked]')
                                        if (elems_sc_checked.length === 0) {
                                            alert('请选择要结算的商品')
                                        } else {
                                            $('form').submit()
                                        }
                                    })

                                    let arr_merchant_id = []
                                    $('[data-merchant-id]').each(function () {
                                        let cur_id = $(this).data('merchant-id')

                                        if (arr_merchant_id.indexOf(cur_id) === -1) {
                                            arr_merchant_id.push(cur_id)
                                        } else {
                                            $(this).remove()
                                        }
                                    })

                                    elem_sc_selectAll.click()
                                })
                            </script>
                            <div class="float-bar-wrapper">
                                <div id="J_SelectAll2" class="select-all J_SelectAll">
                                    <div class="cart-checkbox">

                                    </div>
                                </div>
                                <div class="operations">

                                </div>
                                <div class="float-bar-right">
                                    <div class="amount-sum">
                                        <span class="txt">已选商品</span>
                                        <em id="J_SelectedItemsCount">0</em><span class="txt">件</span>
                                        <div class="arrow-box">
                                            <span class="selected-items-arrow"></span>
                                            <span class="arrow"></span>
                                        </div>
                                    </div>
                                    <div class="price-sum">
                                        <span class="txt">合计:</span>
                                        <strong class="price">¥<em id="J_Total">0.00</em></strong>
                                    </div>
                                    <div class="btn-area">
                                        <a href="javascript:;" id="J_Go" class="submit-btn"
                                           style="background: none;border: none">去&nbsp;结&nbsp;算</a>
                                    </div>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>
            </tr>
            <div class="clear"></div>
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
    <!--操作页面-->

    <!--引导 -->
    <div class="navCir">
        <li><a href="home.html"><i class="am-icon-home "></i>首页</a></li>
        <li><a href="sort.html"><i class="am-icon-list"></i>分类</a></li>
        <li class="active"><a href="shopcar.html"><i class="am-icon-shopping-basket"></i>购物车</a></li>
        <li><a href="person/index.html"><i class="am-icon-user"></i>我的</a></li>
    </div>

    <!-- am-modal -->
    <div class="am-modal am-modal-alert" tabindex="-1" id="doc-modal-alert">
        <div class="am-modal-dialog">
            <div class="am-modal-hd" id="doc-modal-alert-title"></div>
            <div class="am-modal-bd" id="doc-modal-alert-info"></div>
            <div class="am-modal-footer">
                <span class="am-modal-btn">确定</span>
            </div>
        </div>
    </div>

    <script src="/static/js/main.js"></script>
    </body>
    </div>
</html>