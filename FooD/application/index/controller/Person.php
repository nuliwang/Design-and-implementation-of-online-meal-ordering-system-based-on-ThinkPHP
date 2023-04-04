<?php
namespace app\index\controller;
use app\index\validate\Address;
use app\index\validate\Info;
use app\index\validate\Password;
use think\Controller;
use think\Db;
use think\Request;
use think\Session;

class Person extends Controller
{
    public function _initialize()
    {
        // 统计购物车的数量
        $shop_car = Session::get('car');
        $sumcar = empty($shop_car) ? 0 : count($shop_car);
        $this->assign('sumcar',$sumcar);
    }
    
    //个人中心首页
    public function center()
    {
        //判断用户是否登录
        $uid = Session::get('id');
        if (empty($uid)) {
            echo "<script>alert('抱歉，你还未登录!');history.back();</script>";
            die;
        }

    //显示日历(年月日，星期几)
    $nowdate = date('Y-m',time());
    $this->assign('nowdate',$nowdate);
    $day = date('d',time());
    $this->assign('day',$day);
    $num  = date('N',time());
    $this->assign('num',$num);

    //查询登录用户的基本信息
    $info = Db::name('user')
        ->where('user_id',Session::get('id'))
        ->select();

        $this->assign('info',$info);

      return $this->fetch();
    }
    //=======================个人收藏页面=============================

    public function collection()
    {
        //判断用户是否登录
        $uid = Session::get('id');
        if (empty($uid)) {
            echo "<script>alert('抱歉，你还未登录!');history.back();</script>";
            die;
        }
        //接收当前用户的id
        $uid =Session::get('id');
        //连表查询（收藏的goods_id=商品的goods_id  和收藏的user_id=当前登录用户的id）
        $sql = "select * from shop_collect,shop_goods where shop_collect.goods_id=shop_goods.goods_id and shop_collect.user_id=$uid and shop_goods.static=1 order by add_time desc";

        $collect = Db::query($sql);
        $this->assign('collect',$collect);


        return $this->fetch();
    }

    //========================评论页面(评价完)=============================
    public function comment()
    {
        //判断该用户是否登录（不在线提示登录信息）
        $uid = Session::get('id');
        if(empty($uid)){
            echo "<script>alert('抱歉,你还未进行登录，请登录后再进行购买此商品！');history.back();</script>";
            die;
        }
        $uid = Session::get('id');
        //查询该用户商品的评价(全部)
        $comment  = Db::query("select * from shop_goods,shop_comment where shop_comment.user_id=$uid and shop_comment.goods_id=shop_goods.goods_id order by shop_comment.say_time desc");
        $this->assign('comment',$comment);

        //查询该用户商品的评价(有图)
        $comment2  = Db::query("select * from shop_goods,shop_comment where shop_comment.user_id=$uid and shop_comment.goods_id=shop_goods.goods_id and shop_comment.comment_img!='' order by shop_comment.say_time desc");
        $this->assign('comment2',$comment2);
        return $this->fetch();
    }

    //========================评论页面(未评价)=============================
    public function commentlist()
    {
        //判断该用户是否登录（不在线提示登录信息）
        $uid = Session::get('id');
        if(empty($uid)){
            echo "<script>alert('抱歉,你还未进行登录，请先登录！');history.back();</script>";
            die;
        }

        // 接收订单号
        $order_sn = \request()->param('sn');

        // 订单信息
        $order = Db::name('order')
            ->where('order_sn', $order_sn)
            ->find();

        if (empty($order)){
            echo "<script>alert('抱歉,无法找到指定的订单！');history.back();</script>";
            die;
        }

        if($order['order_status'] !== 1){
            echo "<script>alert('抱歉,无法评论未支付成功的订单！');history.back();</script>";
            die;
        }

        // 订单内的商品和评论信息
        $goods_info = [];
        $comment_list = [];
        if (!$order['is_multi']){//单一商品的信息
            $goods_id = $order['goods_id'];
            $goods_num = $order['goods_num'];
            $goods = Db::name('goods')
                ->where('goods_id', $goods_id)
                ->select();
            $goods_info = $goods;
        } else {
            $goods_list = explode('|', $order['goods_list']);//多个商品的用explode函数把商品和ID分开
            $goods_id = json_decode($goods_list[0]);
            $goods_sum = json_decode($goods_list[1]);
            $goods = Db::name('goods')
                ->where('goods_id','in', $goods_id)
                ->order('goods_id', 'desc')
                ->select();
            foreach ($goods as $k => $item){
                $item['goods_sum'] = $goods_sum[$k];
                $goods_info[$item['goods_id']] = $item;
            }
        }

        // 订单相关的评价
        $comments = Db::name('comment')
            ->where('order_sn', $order_sn)
            ->select();
        foreach ($comments as $k => $comment){
            $comment_list[$comment['goods_id']] = $comment;
        }

        // dump($comment_list);die;

        $this->assign('order_sn', $order_sn);
        $this->assign('goods_info',$goods_info);
        $this->assign('comment_list',$comment_list);

        return $this->fetch();
    }
    //商品评价
    public function saygoods()
    {
        //判断该用户是否登录（不在线提示登录信息）
        $uid = Session::get('id');
        if(empty($uid)){
            $this->error('抱歉,你还未进行登录，请先登录！', url('index/user/login'));
        }

        $goods_id = input('param.goodsid');
        $goods_rand = input('param.fell');
        $comment = input('param.content');
        $order_sn = input('param.order_sn');
        $image_path = input('param.images');

        //判断此商品用户是否评论过
        $re = Db::name('comment')
            ->where([
                'order_sn' => $order_sn,
                'goods_id'  => $goods_id
            ])
            ->find();

        if($re){
            returnAjax(0, '此商品已经评论过，请勿重复评论');
            // echo "<script>alert('此商品已经评论过，请勿重复评论');history.back();</script>";
            // die;
        }
        
        if (strlen($comment) < 3) {
            returnAjax(0, '评论字数太少，请重新评论');
            // echo "<script>alert('评论字数太少，请重新评论');history.back();</script>";
            // die;
        }

        //写入数据库
        $result = Db::name('comment')
            ->insert([
                'goods_id'     => $goods_id,
                'user_id'      => $uid,
                'content'      => $comment,
                'say_time'     => time(),
                'goods_rand'   => $goods_rand,
                'comment_img'  => $image_path,
                'order_sn'     => $order_sn
            ]);

        $comment_count = Db::name('comment')->where('goods_id', $goods_id)->count();

        Db::name('goods')
            ->where('goods_id', $goods_id)
            ->update([
                'comment_count' => $comment_count
            ]);

        if($result){
            $this->success('评价成功','index/person/comment');
        }
    }
    //========================个人基本信息设置==============================
    public function information()
    {
        //判断用户是否登录，如果没有登录，直接拦截
        if(!Session::get('id')){
            $this->error('请登录', url('index/user/login'));
        }

        //查询登录用户的基本信息
        $info = Db::name('user')
            ->where('user_id',Session::get('id'))
            ->select();

        $this->assign('info',$info);
        return $this->fetch();
    }
    //=====================个人历史订单详情页面=============================
    public function order()
    {
        //判断该用户是否登录（不在线提示登录信息）
        $uid = Session::get('id');
        if(empty($uid)){
            echo "<script>alert('抱歉,你还未进行登录，请登录后再进行购买此商品！');history.back();</script>";
            die;
        }
        $uid = Session::get('id');

        // 查询用户订单
        // $sql = "select * from shop_order,shop_goods where shop_order.goods_id=shop_goods.goods_id and shop_order.user_id=$uid order by shop_order.add_time desc";
        // $order= Db::query($sql);

        // 商品列表
        $goods=[];
        // 所有与商品信息
        $goods_info = [];
        // 所有用户订单
        $order = Db::name('order')
            ->where('user_id', $uid)
            ->order('order_id','desc')
            ->select();

        foreach ($order as $key => $order_item){//key是id,order_item是order
            if($order_item['is_multi'] == 1){
                // 如果是多个商品 还原商品列表数组
                $goods_list = explode('|', $order_item['goods_list']);
                foreach ($goods_list as $k => $v){
                    $goods_list[$k] = json_decode($v);
                }
                $order[$key]['goods_list'] = $goods_list;

                foreach ($goods_list[0] as $good_id){
                    if(!in_array($good_id, $goods)){
                        // 添加商品信息
                        $goods[] = $good_id;
                        $goods_info[$good_id] = Db::name('goods')->where('goods_id', $good_id)->find();
                    }
                }
            } else {
                // 如果是单商品订单
                $good_id = $order[$key]['goods_id'];

                $order[$key]['goods_list'] = [
                    0 => [$good_id],
                    1 => [$order[$key]['goods_num']]
                ];
                if(!in_array($good_id, $goods)){
                    // 添加商品信息
                    $goods[] = $good_id;
                    $goods_info[$good_id] = Db::name('goods')->where('goods_id', $good_id)->find();
                }
            }
        }

        $this->assign([
            'order' => $order,
            'goods' => $goods,
            'goods_info' => $goods_info
        ]);

        return $this->fetch();
    }
    //==========================收货地址页面================================
    public function address()
    {
        //判断该用户是否登录（不在线提示登录信息）
        $uid = Session::get('id');
        if(empty($uid)){
            echo "<script>alert('抱歉,你还未进行登录，请登录后再进行购买此商品！');history.back();</script>";
            die;
        }
        //查询收货人地址信息
        $adInfo = Db::name('address')
            ->where('user_id',Session::get('id'))
            ->select();

        $this->assign('adInfo',$adInfo);

        return $this->fetch();
    }


    //==========================修改地址页面================================
    public function updateAddress()
    {
        //判断该用户是否登录（不在线提示登录信息）
        $uid = Session::get('id');
        if(empty($uid)){
            echo "<script>alert('抱歉,你还未进行登录，请登录后再进行购买此商品！');history.back();</script>";
            die;
        }

        $adid = input('get.id');
        $addressInfo = Db::name('address')
            ->where('address_id',$adid)
            ->find();
        $this->assign('address',$addressInfo);

        if (Request::instance()->isGet()){
            return $this->fetch();
        }

        if (Request::instance()->isPost()){
            if(empty($addressInfo)){
                echo "<script>alert('抱歉,请至少i填写一个地址！');history.back();</script>";
                die;
            }

            return "<script>alert('地址修改成功！');history.back();</script>";
        }
    }


    //==========================修改密码页面================================
    public function password()
    {
        return $this->fetch();
    }

    //=========================修改用户头像页面============================
    public function updatePic()
    {

        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('image');

        //判断是否选择图片
        if(!$file){
            echo "<script>alert('请选择图片后再更改头像！');history.back();</script>";
            die;
        }

        // 移动到框架应用根目录/public/static/uploads 目录下
        if($file){
            $info = $file->move(ROOT_PATH . 'public' . DS . 'static/uploads');
            if($info){

        // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
               $getSaveName = $info->getSaveName();
               $path = '/static/uploads/'."$getSaveName";

               $truePath =str_replace('\\','/',$path) ;

             $result = Db::name('user')
                 ->where('user_id',Session::get('id'))
                 ->update(['head_pic'=>$truePath]);
             if($result){
                 return $this->success('修改成功');
             }

            }else{
                // 上传失败获取错误信息
                //echo $file->getError();
                return $this->error('系统繁忙，请稍后再试');
            }
        }
    }

    //================================修改用户的基本信息=========================================
    public function updateInfo()
    {
        //接收更改用户输入的数据
        $username = trim(input('post.username')) ;
        $qq = trim(input('post.qq')) ;
        $sex = trim(input('post.sex'));
        $phone = trim(input('post.phone')) ;
        $brithday = trim(input('post.brithday')) ;
        $email = trim(input('post.email')) ;

        //查询当前用户昵称是否为空(昵称唯一性，只让修改一次)
        $nickname = Db::name('user')
                ->field('username')
                ->where('user_id',Session::get('id'))
                ->find();


        //检验用户更改的信息是否和数据库的数据有所冲突
        //用户名
        $result = Db::name('user')
            ->where('username',$username)
            ->where('user_id','<>',Session::get('id'))
            ->select();
        if($result){
            echo  "<script>alert('该用户已存在，请换个昵称！');history.back();</script>";
            die;
        }
        //电话
        $res = Db::name('user')
            ->where('mobile',$phone)
            ->where('user_id','<>',Session::get('id'))
            ->select();
        if($res){
            echo  "<script>alert('该手机已被他人绑定，请更换其他号码！');history.back();</script>";
            die;
        }
        //邮箱
        $re = Db::name('user')
            ->where('email',$email)
            ->where('user_id','<>',Session::get('id'))
            ->select();
        if($re){
            echo  "<script>alert('该邮箱已被他人绑定,请更换其他邮箱！');history.back();</script>";
            die;
        }


        //用验证器验证用户更改资料
        $data = [
            'username' => $username,
            'qq' => $qq,
            'phone' => $phone,
            'brithday' => $brithday,
            'email' => $email,
        ];
        $validate = new Info();

        $result = $validate->check($data);
        if(!$result){
            //错误提示信息
            $notice = $validate->getError();
            return $this->error($notice);

        }
        //当昵称为空时，给用户更改昵称的权限

        if(empty($nickname['username'])) {
            $resu = Db::name('user')
                ->where('user_id', Session::get('id'))
                ->update([
                    'username' => "$username",
                    'qq' => "$qq",
                    'sex' => "$sex",
                    'brithday' => "$brithday",
                    'mobile' => "$phone",
                    'email' => "$email",
                ]);

        }else{
            //当昵称不为空时，不给用户更改昵称的权限

            $resu = Db::name('user')
                ->where('user_id', Session::get('id'))
                ->update([
                    'qq' => "$qq",
                    'sex' => "$sex",
                    'brithday' => "$brithday",
                    'mobile' => "$phone",
                    'email' => "$email",
                ]);
        }

        if($resu){
            return $this->success('更改资料成功');
        }else{
            return $this->error('更新失败，请确定修改后再提交');
        }

    }
//==============================================修改个人密码=========================================================
    public function updatePassword()
    {
        //接收用户提交的旧密码和新密码
        $old = trim(input('post.oldpassword'));
        $new = trim(input('post.newpassword'));
        $renew = trim(input('post.confirmpassword'));
        $code = trim(input('post.code'));
        //检测数据库密码是否正确

        $result = Db::name('user')
            ->where('password',md5($old))
            ->where('user_id',Session::get('id'))
            ->find();
        if(!$result){
            echo  "<script>alert('原密码有误，请重新输入！');history.back();</script>";
            die;
        }
      //用验证器验证用户两次密码是否符合要求
        $data = [
            'password' => $new,
            'repassword' => $renew,
            'code' => $code,
        ];
        $validate = new Password();

        $result = $validate->check($data);
        if(!$result){
            //错误提示信息
            $notice = $validate->getError();
            return $this->error($notice);
        }
        //检验密码是否一致
        if(strcasecmp($new,$renew))
        {
            return $this->error('两次密码不一致');
        }

        //检验验证码是否正确
        $captcha = new \think\captcha\Captcha();
        $res = $captcha->check($code);
        if ($res === false) {
            echo  "<script>alert('验证码错误，请重新输入！');history.back();</script>";
            die;
        }
        //验证成功，更新用户密码
        $re =Db::name('user')
            ->where('user_id',Session::get('id'))
            ->update(['password'=>md5($new)]);
        if($re)
        {
           return $this->success('密码修改成功，请牢记');
        }


    }
   //===============================================收货地址管理=======================================================
    public function addAddress()
    {
        //设置每个用户最多可以有6个收货地址
        $sum = Db::name('address')
            ->where('user_id',Session::get('id'))
            ->count();
        if($sum==6){
            echo  "<script>alert('【注意】：收货地址已到达上线，最多只能为6个收货地址，请删除不必要的地址再继续新增！');history.back();</script>";
            die;
        }

        //接收用户新增地址信息
        $consignee = input('post.consignee');//收货人名字
        $phone = input('post.phone');

        $sheng = input('post.province');
        $shi = input('post.city');
        $qu = input('post.district');
        $address = input('post.address');
        //用验证器验证用户新增
        $data = [
            'username' =>  $consignee,
            'phone'    =>  $phone,
            'address'  =>  $address
        ];
        $validate = new Address();

        $result = $validate->check($data);
        if(!$result){
            //错误提示信息
            $notice = $validate->getError();
            return $this->error($notice);

        }
        //真正的详细地址==省+市+区+街道地址
        $trueAddress = $sheng.$shi.$qu.$address;

        //判断是否是第一次添加收货地址,是的话默认设为默认收货地址
        $re = Db::name('address')
            ->where('user_id',Session::get('id'))
            ->where('is_default',1)
            ->find();
        if($re){


            //验证成功后写入数据库
            $result = Db::name('address')
                ->insert([
                    'user_id'     =>   Session::get('id'),
                    'consignee'   =>   "$consignee",
                    'phone'       =>    $phone,
//                    'address_info'=>    "$trueAddress",
                    'prov'           =>   $sheng,
                    'city'           =>   $shi,
                    'district'       =>   $qu,
                    'address_detail' =>   $address,
                    'address_info'   =>   $trueAddress,
                ]);
            if($result){

                $this->success('新增地址成功^_^^_^^_^');
            }

        }else{

            //验证成功后写入数据库
            $result = Db::name('address')
                ->insert([
                    'user_id'     =>   Session::get('id'),
                    'consignee'   =>   "$consignee",
                    'phone'       =>    $phone,
//                    'address_info'=>    "$trueAddress",
                    'prov'           =>   $sheng,
                    'city'           =>   $shi,
                    'district'       =>   $qu,
                    'address_detail' =>   $address,
                    'address_info'   =>   $trueAddress,
                    'is_default'  =>    1
                ]);
            if($result){

                $this->success('新增地址成功^_^^_^^_^');
            }

        }




    }
    //===========================================删除收货地址=============================================================
    public function delAddress()
    {
       //接收用户要删除地址的id
        $adid = input('get.id');
        if(!empty($adid))
        {
            $del_ad = Db::name('address')
                ->where('address_id',$adid)
                ->find();
            $result = Db::name('address')
                ->where('address_id',$adid)
                ->delete();

            if(!Db::name('address')->where(['is_default'=> 1,'user_id'=>$del_ad['user_id']])->count()){
                Db::name('address')->where(['is_default'=> 0,'user_id'=>$del_ad['user_id']])
                    ->limit(1)->update(['is_default'=>1]);
            }

            if($result){
                $this->success('删除成功');
            }
        }
    }
    //===========================================修改收货地址=============================================================

    public function updateAd()
    {
        //通过隐藏域接受用户地址的id
        $addressid  = (input('param.addressid'));
        //接收用户新增地址信息
        $consignee = input('post.consignee');//收货人名字
        $phone = input('post.phone');

        $sheng = input('post.province');
        $shi = input('post.city');
        $qu = input('post.district');
        $address = input('post.address');
        //用验证器验证用户新增
        $data = [
            'username' =>  $consignee,
            'phone'    =>  $phone,
            'address'  =>  $address
        ];

        $validate = new Address();

        $result = $validate->check($data);
        if(!$result){
            //错误提示信息
            $notice = $validate->getError();
            return $this->error($notice);

        }

        //真正的详细地址==省+市+区+街道地址
        $trueAddress = $sheng.$shi.$qu.' '.$address;
        //验证成功后更新数据库
        $result = Db::name('address')
            ->where('address_id',$addressid)
            ->update([
                'user_id'        =>   Session::get('id'),
                'consignee'      =>   $consignee,
                'phone'          =>   $phone,
                'prov'           =>   $sheng,
                'city'           =>   $shi,
                'district'       =>   $qu,
                'address_detail' =>   $address,
                'address_info'   =>   $trueAddress,
            ]);
        if($result){
            $result_info = '修改地址成功^_^^_^^_^';
            if(Request::instance()->isAjax()){
                return [
                    'code' => 200,
                    'msg'  => $result_info
                ];
            }

            $this->success('修改地址成功^_^^_^^_^','index/person/address');
        }
    }
    //===========================================设置为默认收货地址=============================================================
    //【思想】：先把数据库的默认收货全部修改成0，然后再把提交过来的这个地址修改成1
    public function defaultAd()
    {
        //查出此用户的所有地址id
        $addressid = Db::name('address')
            ->field('user_id,address_id')
            ->where('user_id',Session::get('id'))
            ->select();
       //通过遍历修改
        foreach ($addressid as $value)
        {
            Db::name('address')
                ->where('address_id',$value['address_id'])
                ->update([
                    'is_default'  =>0
                ]);
        }
        //接收用户设为默认的那个地址id
        $id = input('get.id');
        $re = Db::name('address')
            ->where('address_id',$id)
            ->update(['is_default'  =>1]);
        if($re){
            $this->success('设置默认地址成功');
        }

    }

    //===========================================支付设置为默认收货地址=============================================================
    //【思想】：先把数据库的默认收货全部修改成0，然后再把提交过来的这个地址修改成1

    public function newDefault()
    {
        //接收用户新增地址信息
        $consignee = input('post.consignee');//收货人名字
        $phone = input('post.phone');

        $sheng = input('post.province');
        $shi = input('post.city');
        $qu = input('post.district');
        $address = input('post.address');


        //用验证器验证用户新增
        $data = [
            'username' =>  $consignee,
            'phone'    =>  $phone,
            'address'  =>  $address
        ];
        $validate = new Address();

        $result = $validate->check($data);
        if(!$result){
            //错误提示信息
            $notice = $validate->getError();
            return $this->error($notice);
        }

        //真正的详细地址==省+市+区+街道地址
        $trueAddress = $sheng.$shi.$qu.' '.$address;

        //查出此用户的所有地址id
        $addressid = Db::name('address')
            ->field('user_id,address_id')
            ->where('user_id',Session::get('id'))
            ->select();
        //通过遍历修改（字段is_default为0）
        foreach ($addressid as $value)
        {
            Db::name('address')
                ->where('address_id',$value['address_id'])
                ->update([
                    'is_default'  =>0
                ]);
        }
        //验证成功后更新数据库
        $result = Db::name('address')
            ->insert([
                'user_id'        =>   Session::get('id'),
                'consignee'      =>   $consignee,
                'phone'          =>   $phone,
                'prov'           =>   $sheng,
                'city'           =>   $shi,
                'district'       =>   $qu,
                'address_detail' =>   $address,
                'address_info'   =>   $trueAddress,
                'is_default'     =>   1,
            ]);
        if($result){
            $result_info = '新增地址成功！';
            if(Request::instance()->isAjax()){
                return [
                    'code' => 200,
                    'msg'  => $result_info
                ];
            }
            echo  "<script>alert(' . $result_info . ');history.back();</script>";
            die;
        }
    }

    //=========================================删除订单=====================================================
    public function delOrder()
    {
        //接收订单的id
        $orderid = input('param.id');
        $result = Db::name('order')
                ->where('order_id',$orderid)
                ->delete();
        if($result){
            echo  "<script>alert('删除成功！');history.back();</script>";
            die;
        }

    }

    //==========================把购物车的商品移入收藏夹==================================================
    public function moveCollect()
    {
        $goodsid = input('param.id');
        $result = Db::name('collect')
                ->where('user_id',Session::get('id'))
                ->where('goods_id',$goodsid)
                ->find();
        if($result){
            echo  "<script>alert('该商品已存在你的收藏夹中，请勿重复操作！');history.back();</script>";
            die;
        }
        $re = Db::name('collect')
            ->insert([
                'user_id'=>Session::get('id'),
                'goods_id'=>$goodsid,
                'add_time'=>time()
            ]);

        if($re){
//            unset($_SESSION['car'][$goodsid]);
            echo  "<script>alert('商品已移入收藏夹！');history.back();</script>";
            die;
        }

    }

    public function upload_img(){
        $file = request()->file('file'); // 获取上传的文件
        if($file==null){
            returnAjax(1, '未上传图片');
            // exit(json_encode(array('code'=>1,'msg'=>'未上传图片')));
        }
        // 获取文件后缀
        $temp = explode(".", $_FILES["file"]["name"]);
        $extension = end($temp);
        // 判断文件是否合法
        if(!in_array($extension,array("gif","jpeg","jpg","png"))){
            exit(json_encode(array('code'=>1,'msg'=>'上传图片不合法')));
        }
        $info = $file->move(ROOT_PATH.'public'.DS.'uploads'); // 移动文件到指定目录 没有则创建
        $img = '/uploads/'.$info->getSaveName();
        $imgs =str_replace('\\',"/",$img);
        returnAjax(200, $imgs);
    }
}