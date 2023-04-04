<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Session;

class Search extends Controller
{
    public function _initialize()
    {
        // 统计购物车的数量
        $shop_car = Session::get('car');
        $sumcar = empty($shop_car) ? 0 : count($shop_car);
        $this->assign('sumcar',$sumcar);
    }

    //商品搜索页面
    public function searchs()
    {
        // 接收查询的关键字(保存在session，方便销量、好评、价格排序)
        $keys =trim(input('post.keys'));//trim是用来模糊查询的，得到一个或多个汉字进行赋值
        Session::set('keys',$keys);//赋值

        // 如果关键字为空，则关键字为空字符串
        if(empty($keys)){
            $goods = '';
            $keys = Session::get('keys');//取值
        }
        $this->assign('keys',$keys);

        // 商品搜索采用模糊查询（根据商品的标题,分页查询）
        // 查询商品数量
        $goods_count = Db::name('goods')->alias('g')
            ->join('merchant m', 'g.merchant_id=m.id', 'left')
            ->where('g.good_name','like',"%$keys%")
            ->where('g.merchant_id', 'not null')
            ->where('g.status', '=', 1)
            ->where('m.status', '=', 1)
            ->count();
        // 查询商品详情，并分页
        $goods = Db::name('goods')->alias('g')
            ->join('comment c', 'g.goods_id=c.goods_id', 'left')
            ->join('merchant m', 'g.merchant_id=m.id', 'left')
            ->field('g.*,g.comment_count+g.sales_count as comprehensive,m.status as merchant_status')//评价+销量的总和
            ->where('g.good_name','like',"%$keys%")
            ->where('g.merchant_id', 'not null')
            ->where('g.status', '=', '1')//判断商品状态
            ->where('m.status', '=', '1')//判断商户状态
            ->group('g.goods_id')
            ->order('comprehensive', 'desc')
            ->paginate(12);//分页一页里有12个

        // 获取分页显示
        $page = $goods->render();

        // 绑定模板变量
        $this->assign([
            'page'     => $page,
            'goods'    => $goods,
            'sumgoods' => $goods_count
            ]);

        return $this->fetch();
    }


// 商品销售搜索页面
// ==============================================================================
    public function  sales()
    {
        // 接收查询的关键字(保存在session，方便销量、好评、价格排序)
        $keys = Session::get('keys');
        $this->assign('keys',$keys);

        // 如果关键字为空，则关键字为空字符串
        if(empty($keys)) $goods = '';

        // 商品搜索采用模糊查询（根据商品的标题,分页查询）
        $goods_count = Db::name('goods')->alias('g')
            ->join('merchant m', 'g.merchant_id=m.id', 'left')
            ->where('g.good_name','like',"%$keys%")
            ->where('g.merchant_id', 'not null')
            ->where('g.status', '=', 1)
            ->where('m.status', '=', 1)
            ->count();

        $goods = Db::name('goods')->alias('g')
            ->join('merchant m', 'g.merchant_id=m.id', 'left')
            ->where('g.good_name','like',"%$keys%")
            ->where('g.merchant_id', 'not null')
            ->where('g.status', '=', 1)
            ->where('m.status', '=', 1)
            ->order('g.sales_count', 'desc')
            ->paginate(12);

        // 获取分页显示
        $page = $goods->render();
        $this->assign('page', $page);

        $this->assign('goods',$goods);

        // 统计搜索商品的个数
        // $sumgoods = count($goods);
        $this->assign('sumgoods',$goods_count);

        return $this->fetch();
    }

// 商品价格搜索页面
// ============================================================================
    public function  price()
    {
        //接收查询的关键字(保存在session，方便销量、好评、价格排序)
        $keys = Session::get('keys');
        $this->assign('keys',$keys);

        //如果关键字为空，则关键字为空字符串
        if(empty($keys)){
            $goods = '';
        }

        //商品搜索采用模糊查询（根据商品的标题,分页查询）
        $goods_count = Db::name('goods')->alias('g')
            ->join('merchant m', 'g.merchant_id=m.id', 'left')
            ->where('g.good_name','like',"%$keys%")
            ->where('g.merchant_id', 'not null')
            ->where('g.status', '=', 1)
            ->where('m.status', '=', 1)
            ->count();

        $goods = Db::name('goods')->alias('g')
            ->join('merchant m', 'g.merchant_id=m.id', 'left')
            ->where('g.good_name','like',"%$keys%")
            ->where('g.merchant_id', 'not null')
            ->where('g.status', '=', 1)
            ->where('m.status', '=', 1)
            ->order('price')
            ->paginate(12);

        // 获取分页显示
        $page = $goods->render();
        $this->assign('page', $page);

        $this->assign('goods',$goods);

        // 统计搜索商品的个数
        // $sumgoods = count($goods);
        $this->assign('sumgoods',$goods_count);

        return $this->fetch();
    }


//商品评论搜索页面============================================================================
    public function comment()
    {
        //接收查询的关键字(保存在session，方便销量、好评、价格排序)
        $keys = Session::get('keys');
        $this->assign('keys',$keys);

        //如果关键字为空，则关键字为空字符串
        if(empty($keys)){
            $goods = '';

        }

        //商品搜索采用模糊查询（根据商品的标题,分页查询）
        $goods_count = Db::name('goods')->alias('g')
            ->join('merchant m', 'g.merchant_id=m.id', 'left')
            ->where('g.good_name','like',"%$keys%")
            ->where('g.merchant_id', 'not null')
            ->where('g.status', '=', 1)
            ->where('m.status', '=', 1)
            ->count();

        $goods = Db::name('goods')->alias('g')
            ->join('merchant m', 'g.merchant_id=m.id', 'left')
            ->where('g.good_name','like',"%$keys%")
            ->where('g.merchant_id', 'not null')
            ->where('g.status', '=', 1)
            ->where('m.status', '=', 1)
            ->order('g.comment_count', 'desc')
            ->paginate(12);

        // 获取分页显示
        $page = $goods->render();
        $this->assign('page', $page);
        $this->assign('goods',$goods);

        //统计搜索商品的个数
        // $sumgoods = count($goods);
        $this->assign('sumgoods',$goods_count);

        return $this->fetch();
    }



}