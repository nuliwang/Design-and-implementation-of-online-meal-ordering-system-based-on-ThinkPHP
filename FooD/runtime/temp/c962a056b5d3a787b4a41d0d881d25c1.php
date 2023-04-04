<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:73:"D:\PHP\wamp64\www\FooD\public/../application/index\view\article\blog.html";i:1620806095;}*/ ?>
<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="UTF-8">
  <title>新闻页面</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta name="format-detection" content="telephone=no">
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp"/>
  
   <link href="/static/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
   <link href="/static/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">
   <link href="/static/css/personal.css" rel="stylesheet" type="text/css">
</head>
<body>
		<!--头 -->
		<header>
			<article>
				<div class="mt-logo">
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
                                <div class="menu-hd MyShangcheng"><a href="<?php echo url('index/person/center'); ?>" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a></div>
                            </div>
                            <div class="topMessage mini-cart">
                                <div class="menu-hd"><a id="mc-menu-hd" href="<?php echo url('index/goods/shopcar'); ?>" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i>
                                    <span>购物车</span><strong id="J_MiniCartNum" class="h"><?php echo $sumcar; ?></strong></a></div>
                            </div>
                            <div class="topMessage favorite">
                                <div class="menu-hd"><a href="<?php echo url('index/person/collection'); ?>" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a></div>
                        </ul>
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
<!--文章 -->
<div class="am-g am-g-fixed blog-g-fixed bloglist">
  <div class="am-u-md-9">
    <article class="blog-main">
      <h3 class="am-article-title blog-title">
        <a href="#">【标题】：<?php echo $detail['0']['title']; ?></a>
      </h3>
      <h4 class="am-article-meta blog-meta">发布时间：<?php echo $detail['0']['add_time']; ?></h4><br><br>

      <div class="am-g blog-content">
          <?php echo $detail['0']['content']; ?>

        </div>

        <div>
            <img src="<?php echo $detail['0']['article_imgurl']; ?>" width="600px" style="display: block;margin: 20px auto">
            
        </div>
  

    </article>


    <hr class="am-article-divider blog-hr">
    <ul class="am-pagination blog-pagination">

        <li class="am-pagination-next">阅读数：<?php echo $detail['0']['click']; ?> &raquo;</li>
    </ul>
  </div>

  <div class="am-u-md-3 blog-sidebar">
    <div class="am-panel-group">

      <section class="am-panel am-panel-default">
        <div class="am-panel-hd">热门话题</div>
        <ul class="am-list blog-list">

            <?php if(is_array($hot) || $hot instanceof \think\Collection || $hot instanceof \think\Paginator): $i = 0; $__LIST__ = $hot;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
        	<li><a href="<?php echo url('index/article/blog'); ?>?id=<?php echo $value['article_id']; ?>"><p><img src="/static/images/hot.gif"><?php echo $value['title']; ?></p></a></li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
      </section>

    </div>
  </div>

</div>

<div class="footer" >
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

<!--[if lt IE 9]>
<script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="{{assets}}js/amazeui.ie8polyfill.min.js"></script>
<![endif]-->

<!--[if (gte IE 9)|!(IE)]><!-->
<script src="AmazeUI-2.4.2/assets/js/jquery.min.js"></script>
<!--<![endif]-->
<script src="AmazeUI-2.4.2/assets/js/amazeui.min.js"></script>

</body>
</html>