<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use lib\Phone;
use think\Request;
use think\Session;

class Orders extends Person
{
    public function _initialize()
    {
        // 统计购物车的数量
        $shop_car = Session::get('car');
        $sumcar = empty($shop_car) ? 0 : count($shop_car);
        $this->assign('sumcar',$sumcar);

        //判断该用户是否登录（不在线提示登录信息）
        if (empty(Session::get('id'))) $this->error('抱歉,你还未进行登录，请登录后再进行购买此商品！');
    }

    //结算页面======================================================
    public function pay()
    {
        $uid = Session::get('id');

        // 商品信息
        $goodsInfo = '';
        // 商品数量
        $goods_num = 0;
        // 订单是否是多个商品
        $is_multi = 0;

        // 查询用户使用的默认地址
        $address = Db::name('address')
            ->where('user_id', Session::get('id'))
            ->order('is_default desc')
            ->select();
        if(empty($address)){
            $this->error('抱歉,你还未添加收货地址，请添加后再进行购买此商品！', 'index/person/address');
        }

        // 单个商品使用GET方式传参数
        if (Request::instance()->isGet()) {
            //查询立即购买商品订单页
            $goodsid = input('get.id');
            $goods_num = input('get.num');
            if(empty($goods_num)){
                $goods_num = 1;
            }
            $goodsInfo = Db::name('goods')->alias('g')
                ->join('merchant m', 'g.merchant_id=m.id')
                ->field('g.*,m.id=g.goods_id')
                ->where('goods_id','=', $goodsid)
                ->group("g.goods_id")
                ->find();

            // 判断商品 是否存在 或 下架
            if (empty($goodsInfo) || !$goodsInfo['status']) $this->error('抱歉,当前商品不存在或已下架！');
            // 判断店铺是否禁用
            if (!$goodsInfo['status']) $this->error('抱歉,当前商品不存在或已下架！');
            //判断库存是否为0
            if (empty($goodsInfo['repertory'])) $this->error('抱歉,当前库存不足，无法购买此商品！');
        }

        // 多个商品使用POST方式传参数
        if (Request::instance()->isPost()) {
            $params = Request::instance()->param();
            $goods = $params['goods_id'];
            $goods_num = $params['goods_num'];

            foreach ($goods as $k => $v){
                if ($v === ''){
                    array_splice($goods, $k, 1);
                    array_splice($goods_num, $k, 1);
                }
            }

            $goodsInfo = Db::name('goods')
                ->where('goods_id', 'in', $goods)
                ->select();

            $is_multi = 1;
        }

        $this->assign([
            'address_list' => $address,
            'address' => $address[0],
            'goodsInfo' => $goodsInfo,
            'goodssum' => $goods_num,
            'is_multi' => $is_multi,
        ]);

        return $this->fetch();
    }

    //确认支付密码页面===================================================
    public function gopay()
    {
        $uid = Session::get('id');

        //查询个人信息的电话号码（如果没有绑定号码，不让进入这个页面）
        $mobile = Db::name('user')
            ->where('user_id', Session::get('id'))
            ->find();
        if (empty($mobile['mobile'])) {
            echo "<script>alert('你此账号未绑定手机号码，请前往个人中心绑定手机号在继续购买');history.back();</script>";
            die;
        }

        $money = 0;
        $go_pay_action = input('param.action');
        if(empty($go_pay_action)) $go_pay_action = 'add_order';

        $is_multi = input('param.is_multi');
        if (!in_array($is_multi, [0, 1])) {
            echo "<script>alert('请求参数错误');history.back();</script>";
            die;
        }

        $param = Request::instance()->param();
        //接收提交过来的商品信息id(单价和数量、留言)
        $goodsid = $param['id'];
        //数量
        $goodssum = $param['goodssum'];
        //留言
        $message = $param['message'];
        //支付方式
        $payway = $param['payway'];
        // 地址ID
        $order_addID = $param['order_addID'];

        $goodsInfo = Db::name('goods')->alias('g')
            ->join('merchant m', 'g.merchant_id=m.id')
            ->field('g.*, m.status as merchant_status')
            ->where('g.goods_id', 'in', $goodsid)
            ->group('g.goods_id')
            ->select();

        // 遍历订单中的商品
        foreach ($goodsInfo as $k => $item) {
            // 订单总金额
            $money += $item['price'] * $goodssum[$k];
            // 查询库存
            if($goodssum[$k] > $item['repertory']) $this->error('订单中的商品（' . $item['good_name'] . '）库存不足，请选择合适的数量进行购买');
            // 查询商品和店铺的状态
            if(!$item['status'] || !$item['merchant_status']) $this->error('抱歉,订单中的商品（' . $item['good_name'] . '）不存在或已下架！');
        }

        // 配置单商品
        if (!$is_multi) {
            //查询商品信息
            $goodsInfo = $goodsInfo[0];
            $goods_id = $goodsInfo['goods_id'];
            $this->assign('goods_id', $goods_id);
            $money = $goodssum * $goodsInfo['price'];
        }

        // 生成订单号（日期+随机数，不够自动填充0）
        $ordernum = date('YmdHis') . str_pad(mt_rand(1, 99999), 6, '0', STR_PAD_LEFT);
        
        //查询是否填写地址
        if(!empty($order_addID)){
            $r = Db::name('address')
                ->where('address_id', $order_addID)
                ->find();
        }else{
            // 未填写则使用默认地址
            $r = Db::name('address')
                ->where('user_id', Session::get('id'))
                ->where('is_default', 1)
                ->find();
        }

        if (!$r) {
            echo "<script>alert('你还未填写收货地址,请填写后再继续购买');history.back();</script>";
            die;
        }

        // 整合订单数据
        $goods_list = json_encode($goodsid) . '|' . json_encode($goodssum);
        $db_data = [
            'order_sn' => $ordernum,
            'order_status' => 0,
            'user_id' => Session::get('id'),
            'order_address' => $r['address_info'],
            'consignee' => $r['consignee'],
            'mobile' => $r['phone'],
            'goods_price' => $money,
            'add_time' => time(),
            'message' => $message,
            'goods_id' => 0,
            'goods_num' => 0,
            'goods_list' => '',
            'is_multi' => $is_multi
        ];

        if($is_multi == 0){
            $db_data['goods_id']  = $goodsid;
            $db_data['goods_num'] = $goodssum;
        } elseif ($is_multi == 1) {
            $db_data['goods_num'] = array_sum($goodssum);
            $db_data['goods_list']  = $goods_list;
        }

        // 判断是否取消订单
        if($go_pay_action === 'cancel_order'){
            // 修改订单状态的参数为2
            $db_data['order_status'] = 2;
            // 把数据写入数据库
            $re = Db::name('order')->insert($db_data);

            if($re) $this->success('订单已取消', "index/person/order");
        }

        // 判断是否支付宝
        if($payway == 'alipay'){
            // 订单数据写入数据库
            $re = Db::name('order')->insert($db_data);
            // 跳转支付宝付款
            if($re) $this->redirect(url('index/alipay/paypage', ['subject'=>'测试订单', 'total_amount'=>$money, 'out_trade_no'=>$ordernum, 'body'=>'']));

            $this->error('创建订单失败，请联系管理员', "index/index/index");
        }

        $phone = newphone($mobile['mobile']);

        // 传递变量到模板
        $this->assign([
            'goodssum' => $goodssum,
            'goodsInfo' => $goodsInfo,
            'message' => $message,
            'money' => $money,
            'ordernum' => $ordernum,
            'is_multi' => $is_multi,
            'payway' => $payway,
            'phone' => $phone,
        ]);

        return $this->fetch();
    }

    //=======================================结算订单============================================================
    public function indent()
    {
        //判断该用户是否登录（不在线提示登录信息）
        $uid = Session::get('id');

        $is_multi = input('post.is_multi');
        $params = Request::instance()->param();
        //查询收货地址信息默认是为1
        $address = Db::name('address')
            ->where('is_default', 1)
            ->where('user_id', Session::get('id'))
            ->find();

        //收货人
        $addressUser = $address['consignee'];
        //手机号
        $phone = $address['phone'];
        //收货地址
        $adDefault = $address['address_info'];
        //商品总价
        $money = $params['money'];
        //订单号
        $ordernum = $params['ordernum'];
        //买家留言
        $message = $params['message'];


        //商品id
        $goodsid = $params['goods_id'];
        //商品数量
        $goodssum = $params['goodssum'];
        // 订单中的商品列表
        $goods_list = '';

        //看提交过来的是验证码还是确定支付
        //当点击按钮提交是短信验证时，执行发送短信代码
        $mobile1 = Db::name('user')
            ->field('mobile')
            ->where('user_id', Session::get('id'))
            ->find();
        $mobile = $mobile1['mobile'];

        $sms = input('post.sms');
        if ($sms == '获取验证码') {

            //初始化必填
            //填写在开发者控制台首页上的Account Sid
            $options['accountsid'] = '60ec21d7637ac20b58fe2b36aec10526';
            //填写在开发者控制台首页上的Auth Token
            $options['token'] = 'efa053eff7214905a59a72c191f3cc93';
            //初始化 $options必填
            $ucpass = new Phone($options);

            $appid = "db870b45151d44ad8b4f5b5c2f8b2165";    //应用的ID，可在开发者控制台内的短信产品下查看
            $templateid = "293523";    //可在后台短信产品→选择接入的应用→短信模板-模板ID，查看该模板ID
            $param = mt_rand(1000, 9999); //多个参数使用英文逗号隔开（如：param=“a,b,c”），如为参数则留空
            //$mobile = $_POST['yzmtel'];
            $uid = "";

//70字内（含70字）计一条，超过70字，按67字/条计费，超过长度短信平台将会自动分割为多条发送。分割后的多条短信将按照具体占用条数计费。

            $notice = json_decode($ucpass->SendSms($appid, $templateid, $param, $mobile, $uid))->code;

            //只有当$notice = 000000才表示发送成功
            if ($notice == 000000) {


                Session::set('zfm', $param);
                //echo "<script>alert('发送成功,请你注意查收');history.back();</script>";
                $this->success('短信已发送，请你注意查看', "index/orders/gopay?id=$goodsid&goodssum=$goodssum&message=$message");
                die;
            } else {
                echo "<script>alert('短信发送失败,请稍候再试');history.back();</script>";
            }

        }
        //完成订单操作
        $submit = input('post.submit');

        if ($submit == '确定支付') {
            //接收验证码(支付码)


            //检验密码是否正确
            $password = md5(rtrim(input('param.password')));
            $result = Db::name('user')
                ->where('user_id', Session::get('id'))
                ->where('password', $password)
                ->find();

            if (!$result) {
                $this->success('密码错误，请重新输入', "index/orders/gopay?id=$goodsid&goodssum=$goodssum&message=$message");
            }


            $re = 0;

            $goods_list = json_encode($goodsid) . '|' . json_encode($goodssum);

            $db_data = [
                'order_sn' => $ordernum,
                'order_status' => 1,
                'user_id' => Session::get('id'),
                'order_address' => $adDefault,
                'consignee' => $addressUser,
                'mobile' => $phone,
                'goods_price' => $money,
                'add_time' => time(),
                'message' => $message,
                'goods_id' => 0,
                'goods_num' => 0,
                'goods_list' => '',
                'is_multi' => $is_multi
            ];

            // 购物车数据
            $session_car = Session::get('car');

            if ($is_multi == 0) {
                $db_data['goods_id']  = $goodsid;
                $db_data['goods_num'] = $goodssum;

                //数据验证成功,写入数据库中
                $re = Db::name('order')->insert($db_data);

                //商品购买，库存数量-,销量+
                $sql = "update shop_goods set sales_count=sales_count+" . $goodssum . ",repertory=repertory-" . $goodssum . " where goods_id=" . $goodsid;


                if($re){
                    Db::execute($sql);

                    // 删除购物车 Session
                    unset($session_car[$goodsid]);
                }


            } elseif ($is_multi == 1) {
                $db_data['goods_num'] = array_sum($goodssum);
                $db_data['goods_list']  = $goods_list;

                $re = Db::name('order')->insert($db_data);

                if($re) {

                    foreach ($goodsid as $k => $vo) {
                        unset($session_car[$goodsid[$k]]);
                        $sql = "update shop_goods set sales_count=sales_count+" . $goodssum[$k] . ",repertory=repertory-" . $goodssum[$k] . " where goods_id=" . $vo;
                        Db::execute($sql);
                    }
                }

            }

            if($re) {
                // 储存购物车的数据
                Session::set('car', $session_car, 'think');
                Db::name('car')->where('user_id', $uid)->update([
                    'goods_info' => json_encode($session_car)
                ]);

                $this->success('支付成功，请稍等', "index/orders/successs?ordernum=" . $ordernum);
            } else {
                $this->success('支付失败，请联系管理员', "index/index/index");
            }
        }
    }

    //==============================================================
    //付款成功页面
    public function successs()
    {
        $uid = Session::get('id');
        $money = 0;
        $ordernum = input('param.ordernum');

        if(empty($ordernum)){
            $this->redirect(url('index/person/order'));
        }

        if (empty($ordernum)) { // 最开始查商品id的版本 迷惑操作
            //接收商品id
            $price1 = Db::name('goods')
                ->field('price')
                ->where('goods_id', input('param.id'))
                ->find();

            //单价
            $price = $price1['price'];
            //数量
            $num = input('param.sum');
            //总共支付
            $money = $price * $num;

            //查询收货地址
            $address = Db::name('address')
                ->where('user_id', Session::get('id'))
                ->where('is_default', 1)
                ->find();

            $this->assign('ordernum', date('YmdHis') . str_pad(mt_rand(1, 99999), 6, '0', STR_PAD_LEFT));
            $this->assign('arrival_time', date('Y-m-d H:i:s', time() + 600));
            $this->assign('money', $money);
            $this->assign('address', $address);

            return $this->fetch();
        } else {
            // 根据订单号查询数据库
            $orderInfo = Db::name('order')
                ->where('order_sn', $ordernum)
                ->find();

            if(empty($orderInfo)){
                $this->error('抱歉,没有找到订单信息');
            }

            if($orderInfo['order_status'] !== 1){
                $this->error('订单未完成！');
            }

            $address = [
                'consignee' => $orderInfo['consignee'],
                'phone' => $orderInfo['mobile'],
                'address_info' => $orderInfo['order_address'],
            ];

            if (empty($orderInfo)) {
                echo "<script>alert('抱歉,没有找到订单信息！');history.back();</script>";
                die;
            }
            if ($orderInfo['is_multi'] == 1 && empty($orderInfo['goods_list'])) {
                echo "<script>alert('抱歉,没有找到订单信息！');history.back();</script>";
                die;
            }
            $this->assign('order_num', $ordernum);

            $arrival_time = date('Y-m-d H:i:s', $orderInfo['add_time'] + 3600);

            if($orderInfo['is_multi'] == 0){
                $single_price = Db::name('goods')->where('goods_id', $orderInfo['goods_id'])->find();
                $money = sprintf('%.2f', $single_price['price'] * (int)$orderInfo['goods_num']);

                $this->assign('money', $money);
                $this->assign('arrival_time', $arrival_time);
                $this->assign('address', $address);
                return $this->fetch();
            }

            if($orderInfo['is_multi'] == 1){

                $this->assign('money', $orderInfo['goods_price']);
                $this->assign('arrival_time', $arrival_time);
                $this->assign('address', $address);


                return $this->fetch();
            }

            echo "<script>alert('抱歉,没有找到订单信息！');history.back();</script>";
            die;
        }
    }

}