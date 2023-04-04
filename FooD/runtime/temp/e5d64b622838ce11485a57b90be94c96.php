<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:77:"D:\PHP\wamp64\www\FooD\public/../application/backend\view\merchant\index.html";i:1620872937;s:64:"D:\PHP\wamp64\www\FooD\application\backend\view\layout\head.html";i:1620872936;}*/ ?>
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
    <form class="layui-form">
    <div class="layui-form-item">
        <label class="layui-form-label">店铺名称</label>
        <div class="layui-input-block">
            <input type="text" name="name" lay-verify="title" autocomplete="off" value="<?php echo $detail['name']; ?>" placeholder="请输入店铺名称" class="layui-input">
        </div>
    </div>
        <div class="layui-form-item">
            <label class="layui-form-label">店铺分类</label>
            <div class="layui-input-block">
                <select name="class_id" lay-filter="aihao">

                    <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                    <option value="<?php echo $v['classify_id']; ?>" <?php if($v['classify_id']==$detail['class_id']): ?> selected<?php endif; ?>><?php echo $v['name']; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>


                </select>
            </div>
        </div>


        <div class="layui-form-item">
            <label class="layui-form-label">店铺简介</label>
            <div class="layui-input-block">
                <input type="text" name="introduce" lay-verify="title" autocomplete="off" value="<?php echo $detail['introduce']; ?>" placeholder="请输入店铺资料" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">注册时间</label>
            <div class="layui-input-block">
                <input type="text"  lay-verify="title" autocomplete="off" value="<?php echo $detail['add_time']; ?>"  disabled placeholder="请输入店铺资料" class="layui-input">
            </div>
        </div>

    <div class="layui-form-item">
        <label class="layui-form-label">店铺logo</label>
        <div class="layui-input-block">

            <button class="layui-btn layui-btn-sm" onclick="return false;" id="upload_img">
                <i class="layui-icon">&#xe67c;</i>上传图片
            </button>
            <input type="hidden" name="logo" value="">
        </div>
    </div>

        <div class="layui-form-item" style="margin-left: 50px">
            <img id="pre_img" src="<?php echo $detail['logo']; ?>" width="500px" alt="">
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">是否审核</label>
            <div class="layui-input-block">
                <?php if($detail['status']==1): ?>
                <input type="radio" name="status" value="1" title="已通过" checked="">
                <input type="radio" name="status" value="0" title="未通过" disabled>

                    <span class="x-red">*</span>此项只能管理员修改

                <?php else: ?>
                <input type="radio" name="status" value="0" title="未通过"  checked="">
                <input type="radio" name="status" value="1" title="已通过"  disabled>
                <span class="x-red">*</span>此项只能管理员修改
                <?php endif; ?>

            </div>
        </div>

        <!--隐藏id-->
        <input type="hidden" name="id" value="<?php echo $detail['id']; ?>">
        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label">
            </label>
            <button  class="layui-btn" lay-filter="add" lay-submit="">
                确认修改
            </button>
        </div>
    </form>
</div>
<script>

    layui.use(['upload','jquery'],function () {
        $ = layui.jquery;
        var upload = layui.upload;
        //执行实例
        var uploadInst = upload.render({
            elem: '#upload_img' //绑定元素
            ,url: '/backend/base/upload_img' //上传接口
            ,accept:'images'
            ,done: function(res){
                //上传完毕回调
                $('#pre_img').attr('src',res.msg);
                $('input[name="logo"]').val(res.msg);
            }
            ,error: function(){
                //请求异常回调
            }
        });
    });

</script>
<script>
    layui.use(['form','layer'], function(){
        $ = layui.jquery;
        var form = layui.form
            ,layer = layui.layer;
        //监听提交
        form.on('submit(add)', function(data){
            console.log(data);
            //发异步，把数据提交给php
            $.ajax({
                    type:'post',
                    url:'/backend/merchant/edit',
                    data: data.field,
                    dataType:'json',
                    success:function (data) {
                        if(data.code==200) {
                            layer.alert(data.msg, {icon: 6});
                          return false;

                        }else {
                            layer.alert(data.msg, {icon: 5});
                            return false;
                        }
                    }
                }
            )
            return false;


        });


    });
</script>
</body>

</html>