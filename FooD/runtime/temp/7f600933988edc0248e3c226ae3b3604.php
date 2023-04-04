<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:74:"D:\PHP\wamp64\www\FooD\public/../application/backend\view\goods\index.html";i:1620872935;s:64:"D:\PHP\wamp64\www\FooD\application\backend\view\layout\head.html";i:1620872936;}*/ ?>
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
<div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">演示</a>
        <a>
          <cite>导航元素</cite></a>
      </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>
<div class="x-body">
    <div class="layui-row">

    </div>
    <xblock>

        <button class="layui-btn" onclick="x_admin_show('添加菜品','/backend/goods/add')"><i class="layui-icon"></i>添加</button>
        <span class="x-right" style="line-height:40px">共有数据：<?php echo $list->total(); ?> 条</span>
    </xblock>
    <table class="layui-table">
        <thead>
        <tr>
            <th>
                <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
            </th>
            <th>ID</th>
            <th>菜品名称</th>
            <th>图片</th>
            <th>简介</th>
            <th>原价</th>
            <th>现价</th>
            <th>库存</th>
            <th>状态</th>
            <th>操作</th>
        </thead>
        <tbody>
        <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
        <tr>
            <td>
                <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='2'><i class="layui-icon">&#xe605;</i></div>
            </td>
            <?php
                if(empty($page))$page = 1;
                $index = ($page-1)*$listRows+$key+1
            ?>
            <td><?php echo $index; ?></td>
            <td><?php echo $v['good_name']; ?></td>
            <td><img src="<?php echo $v['imgpath']; ?>" height="60px" alt=""></td>
            <td><?php echo $v['desc']; ?></td>
            <td><?php echo $v['market']; ?></td>
            <td><?php echo $v['price']; ?></td>
            <td><?php echo $v['repertory']; ?></td>
            <td class="td-status">
                <?php if($v['status']==1): ?>
                <span class="layui-btn layui-btn-normal layui-btn-mini">已启用</span>
                <?php else: ?>
                <span class="layui-btn layui-btn-danger layui-btn-mini">已禁用</span>
                <?php endif; ?>
            </td>
            <td class="td-manage">

                <a title="编辑"  onclick="x_admin_show('编辑','/backend/goods/edit?id=<?php echo $v['goods_id']; ?>')" href="javascript:;">
                    <i class="layui-icon">&#xe642;</i>
                </a>
                <a title="删除" onclick="member_del(this,'<?php echo $v['goods_id']; ?>')" href="javascript:;">
                    <i class="layui-icon">&#xe640;</i>
                </a>
            </td>
        </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>

        </tbody>
    </table>
    <div class="page">
        <?php echo $list->render(); ?>
    </div>

</div>

</body>
<script>
    /*用户-删除*/
    function member_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            //发异步删除数据
            $.ajax({
                    type:'post',
                    url:'/backend/goods/del',
                    data: {'id':id},
                    dataType:'json',
                    success:function (data) {
                        if(data.code==200) {
                            $(obj).parents("tr").remove();
                            layer.msg('已删除!',{icon:1,time:1000});
                            return false;
                        }else {
                            layer.alert(data.msg, {icon: 5});
                            return false;
                        }
                    }
                }
            )
        });
    }

</script>

</html>