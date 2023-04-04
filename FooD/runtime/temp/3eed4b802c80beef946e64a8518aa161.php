<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:73:"D:\PHP\wamp64\www\FooD\public/../application/backend\view\user\index.html";i:1620872937;s:64:"D:\PHP\wamp64\www\FooD\application\backend\view\layout\head.html";i:1620872936;}*/ ?>
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
        <a><cite>导航元素</cite></a>
      </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>
<div class="x-body">
    <xblock>
        <button class="layui-btn" onclick="x_admin_show('添加商户','/backend/user/add')"><i class="layui-icon"></i>添加用户</button>
        <button class="layui-btn" onclick="batch_del()"><i class="layui-icon"></i>批量删除</button>
        <span class="x-right" style="line-height:40px">共有<?php echo $list->total(); ?>条数据</span>
    </xblock>
    <table class="layui-table">
        <thead>
        <tr>
            <th style="width: 2em">
                <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
            </th>
            <th style="width: 2em">序号</th>
            <th>登录名</th>
            <th>头像</th>
            <th>手机</th>

            <th>加入时间</th>

            <th>操作</th>
        </thead>
        <tbody>
        <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?>
        <tr style="text-align: center">
            <td>
                <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='<?php echo $v['user_id']; ?>'><i class="layui-icon">&#xe605;</i></div>
            </td>
            <?php
                if(empty($page))$page = 1;
                $index = ($page-1)*$listRows+$key+1
            ?>
            <td><?php echo $index; ?></td>
            <td><?php echo $v['username']; ?></td>
            <td><img src="<?php echo $v['head_pic']; ?>" height="40px" alt=""></td>
            <td><?php echo $v['mobile']; ?></td>
            <td> <?php echo date("Y-m-d H:i:s",$v['reg_time']); ?></td>

            <td class="td-manage">

                <a title="删除" onclick="member_del(this,'<?php echo $v['user_id']; ?>')" href="javascript:;">
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
<script>

    /*用户-删除*/
    function member_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            $.ajax({
                    type:'post',
                    url:'/backend/user/del',
                    data: {'id':id},
                    dataType:'json',
                    success:function (data) {
                        if(data.code==200) {
                            $(obj).parents("tr").remove();
                            layer.msg('已删除!',{icon:1,time:1000});
                            window.location.reload();
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

    function batch_del(){
        let elem_input_checcked = $('.layui-form-checked'),
            ids=[]

        elem_input_checcked.each(function (item){
            ids.push($(this).data('id'))
        })

        layer.confirm('确认要删除吗？',function(){
            //发异步删除数据
            $.ajax({
                type:'post',
                url:'/backend/user/del',
                data: {'id': ids},
                dataType:'json',
                success:function (data) {
                    if(data.code==200) {
                        layer.msg('已删除!',{icon:1,time:1000});
                        window.location.reload();
                    }else {
                        layer.alert(data.msg, {icon: 5});
                    }
                }
            })
        });
    }


</script>

</body>

</html>