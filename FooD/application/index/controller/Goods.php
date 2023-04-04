<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Request;
use think\Session;
use think\Cookie;

class Goods extends Controller
{
    public function _initialize()
    {
        // 统计购物车的数量
        $shop_car = Session::get('car');
        $sumcar = empty($shop_car) ? 0 : count($shop_car);
        $this->assign('sumcar',$sumcar);
    }

    //商品详情页
    public function introduction()
    {
        //接收商品的id
        $goodsid = input('get.id');

        $uid = Session::get('id');

        //商品基本信息
        $goodsInfo = Db::name('goods')->alias('g')
            ->join('merchant m', 'm.id=g.merchant_id', 'left')
            ->field('g.*,m.status as merchant_status')
            ->group('g.goods_id')
            ->where('goods_id', $goodsid)
            ->select();

        if(empty($goodsInfo)){
            $this->error('抱歉，该商品不存在或已下架！');
        }

        if($goodsInfo[0]['status']==0 || $goodsInfo[0]['merchant_status']==0){
            $this->error('抱歉，该商品不存在或已下架！');
        }

        $this->assign('goodsInfo', $goodsInfo);

      


        //看了又看（推荐商品）
        $recommend = Db::name('goods')
            ->order('goods_id desc')
            ->limit(12)
            ->select();
        //打乱一下数组
        shuffle($recommend);

        $this->assign('recommend', $recommend);

        //猜你喜欢（推荐商品，购买次数）
        $recommend2 = Db::name('goods')
            ->order('sales_count desc')
            ->limit(12)
            ->select();
        //打乱一下数组
        shuffle($recommend2);
        $this->assign('recommend2', $recommend2);

        //经典套装（销量最高的食品）
        $recommend3 = Db::name('goods')
            ->order('comment_count desc')
            ->limit(10)
            ->select();

        //打乱
        shuffle($recommend3);
        //取出四个商品展示
        $recommend3 = array_slice($recommend3, 0, 4);

        $this->assign('recommend3', $recommend3);

        //获取用户的id显示具体的地理位置
        $request = Request::instance();
        $clientIP = $request->ip();
        //$clientIP ='113.88.65.0';
        //调用阿里获取地理位置接口
    /*    $taobaoIP = 'http://ip.taobao.com/service/getIpInfo.php?ip='.$clientIP;
        $IPinfo = json_decode(file_get_contents($taobaoIP));
        $province = $IPinfo->data->region;
        $city = $IPinfo->data->city;*/
        //返回省份和市
        //$data = $province.$city;
        //$this->assign('province',$province);
        //$this->assign('city',$city);


        //查询评价信息
        $comment  = Db::query("select * from shop_user,shop_comment where shop_comment.goods_id=$goodsid and shop_comment.user_id=shop_user.user_id  order by shop_comment.say_time desc");

        $this->assign('comment',$comment);

        //查询好评，差评，中评数
        $good = Db::name('comment')
                ->where('goods_id',$goodsid)
                ->where('goods_rand',1)
                ->count();
        $this->assign('good',$good);

        $ordinary = Db::name('comment')
            ->where('goods_id',$goodsid)
            ->where('goods_rand',2)
            ->count();
        $this->assign('ordinary',$ordinary);

        $bad = Db::name('comment')
            ->where('goods_id',$goodsid)
            ->where('goods_rand',3)
            ->count();
        
        $this->assign('bad',$bad);
        
        //总评三者相加
        $sum = $good+$ordinary+$bad;
        $this->assign('sum',$sum);
        
        //好评度（中评+好评/总评）
        if($sum==0){
            $sum=1;
        }
        $ratio = sprintf("%.2f",($good+$ordinary)/$sum*100);
        $this->assign('ratio',$ratio);



        return $this->fetch();
    }

    // 购物车通用方法
    private function common_getShoppingCar()
    {
        //判断用户是否登录
        $uid = Session::get('id');
        if (empty($uid)) {
            $this->error('请先登录账号', url('index/user/login'));
        }

        // 先查数据库看有没有数据
        $shop_car = Db::name('car')
            ->where(['user_id'=>$uid])
            ->find();
        $session_car = [];

        if ($shop_car['goods_info'] === 'null'){
            $shop_car['goods_info'] = [];
        }

        // 如果没有购物车数据
        if(empty($shop_car)){
            // 创建 Session car
            Session::set('car', $session_car, 'think');

            // 在表里插入数据
            Db::name('car')->update([
                'user_id'    => $uid,
                'goods_info' => ''
            ]);
        } else {
            //取出购物车里面商品信息
            if(!empty($shop_car['goods_info'])){
                $session_car = json_decode($shop_car['goods_info'], true);
            }
        }

        // 返回Session中的购物车数据
        return $session_car;
    }

    private function common_saveShoppingCar($car_data)
    {
        Session::set('car', $car_data, 'think');
        return Db::name('car')->where('user_id', Session::get('id'))->update([
            'goods_info' => json_encode($car_data)
        ]);
    }

    //================================================购物车页面===================================================
    public function shopcar()
    {
        $session_car = $this->common_getShoppingCar();

        $cart = [];

        //判断购物车是否有物品
        if (!empty($session_car)) {
            $goods_id = array_keys($session_car);
            //查询购物车里面的商品
            $cart = Db::name('goods')
                ->join('shop_merchant', 'shop_goods.merchant_id = shop_merchant.id')
                ->where('goods_id', 'in', $goods_id)
                ->select();
        }

        $this->assign([
            'cart' => $cart,
            'session_car' => $session_car
        ] );

        return $this->fetch();
    }

    //================================================加入购物车===================================================
    public function addcar()
    {
        $params = Request::instance()->param();//获取当前请求的变量
        $id = $params['id'];
        $num = empty($params['num']) ? 1 : $params['num'];

        if(empty($id)) $this->error('请确认商品信息后重试！');

        $session_car = $this->common_getShoppingCar();

        //判断商品是否存在购物车中
        if (array_key_exists($id, $session_car)) {
            echo "<script>alert('该商品已存在购物车，请勿重复添加！');history.back();</script>";
            die;
        }

        //用session保存商品信息
        $session_car[$id] = $num;

        if($this->common_saveShoppingCar($session_car)) $this->success('成功加入购物车！');
    }

    //================================================编辑购物车===================================================
    public function editcar()
    {
        $session_car = $this->common_getShoppingCar();

        $uid = Session::get('id');
        $params = request()->param();
        if(Request::instance()->isAjax()){
            foreach ($params['data'] as $k => $v){
                $id = $v['id'];
                $num = empty($v['num']) ? 1 : $v['num'];
                $session_car[$id] = $num;
            }
        }

        if($this->common_saveShoppingCar($session_car)) returnAjax(200, '修改成功');
    }

    //================================================删除购物车的商品======================================
    public function delCart()
    {
        //接收商品的id(因为购物车session的下标跟商品的id是相同的)
        $id = input('get.id');
        $session_car = $this->common_getShoppingCar();

        unset($session_car[$id]);

        if($this->common_saveShoppingCar($session_car)) $this->success('从购物车删除商品成功');

    }

    //================================================收藏商品=========================================
    public function addCollection()
    {
        //查看用户是否登录
        $uid = Session::get('id');
        if(empty($uid)){
            $this->error('请先登录账号', url('index/user/login'));
        }

        //接收商品的id
        $gid = input('get.id');

        //判断数据库是否存在此商品
        $re = Db::name('collect')
            ->where('goods_id',$gid)
            ->where('user_id',$uid)
            ->select();
        if ($re) {
            echo "<script>alert('该商品已存在你的收藏夹中，请勿重复添加');history.back();</script>";
            die;
        }



        $result = Db::name('collect')
            ->insert([
                    'user_id' => Session::get('id'),
                    'goods_id' => $gid,
                    'add_time' => time()
                ]
            );
        if ($result) {
            echo "<script>alert('收藏成功');history.back();</script>";
            die;
        }


    }

    //================================================取消收藏商品=========================================
    public function delCollection()
    {
        //接收收藏商品的id
        $cid = input('get.id');

        $result = Db::name('collect')
            ->where('collect_id', $cid)
            ->delete();
        if ($result) {
            echo "<script>alert('取消成功');history.back();</script>";
        }

    }


}