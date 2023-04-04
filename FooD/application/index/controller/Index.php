<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Session;

class Index extends Controller
{
    //首页页面===========================================================================
    public function index()
    {
    //查询用户的基本信息（头像，昵称）=============
    $userInfo = Db::name('user')
           ->where('user_id',Session::get('id'))
           ->select();
    $this->assign('userInfo',$userInfo);
    //右边公告通知(最新降序、id自增，得出最新消息)====================
    $hot = Db::name('article')
        ->field('title,allowcomments,article_id')
        ->where('state',1)
        ->order('article_id desc')
        ->limit(5)
        ->select();

    $this->assign('hot',$hot);
    
    //一级分类
    $one = Db::name('classify')//数据库classify中查询
        ->where('level',1)//找到表中level字段为1的
        ->where('status','1')//找到表中status字段为1的
        ->select();
    $this->assign('one',$one);//对模板赋值----循环输出
        

    //首页 层数 商品（1、2、3、4、5层）

    $shop = Db::name('merchant')->where('status', 1)->select();
    $this->assign('shop', $shop);

    $sortgoods = Db::name('goods')
        ->where('static',1)
        ->select();
    $this->assign('sortgoods',$sortgoods);

    //统计购物车的数量
    if(!empty($_SESSION['car'])){
        $sumcar = count($_SESSION['car']);
        $this->assign('sumcar',$sumcar);
    }else{
        $this->assign('sumcar',0);
    }

    //今日推荐（最新的三个商品）
    $goods = Db::name('goods')->alias('g')//给goods表起个别名方便下面操作
            ->join('merchant m', 'm.id=g.merchant_id', 'left')//join方法，type：left即使右表中没有匹配，也从左表返回所有的行
            ->field('g.imgpath,g.good_name,g.goods_id,g.status,m.status as merchant_status')//查询商品图片地址，商品名，商品id。商品状态，商户的状态作为商户状态
            ->group('g.goods_id')//按照商品id进行分组统计
            ->where('g.status', '=', '1')//条件商品的状态为1
            ->where('m.status', '=', '1')//条件商户的状态为1
            ->order('g.goods_id desc')//倒叙
            ->limit(3)//限制三个
            ->select();
    $this->assign('goods',$goods);

    // 商家列表
    $list = Db::name('merchant')
        ->alias('m')
        ->where('m.status',1)
        ->field('m.*,classify.name as class_name')
        ->join('classify','m.class_id=classify.classify_id','left')
        ->order('id desc')
        ->limit(8)
        ->select();
    $this->assign('list',$list);

    // 统计购物车的数量
    $shop_car = Session::get('car');
    $sumcar = empty($shop_car) ? 0 : count($shop_car);
    $this->assign('sumcar',$sumcar);

    return  $this->fetch();
    }

    //====================================用户退出登录===============================================
    public function loginOut()
    {
        // 清除session（当前作用域）
        $shop_car = Session::get('car');
        Session::destroy();
        $this->success('退出成功');

    }
}
