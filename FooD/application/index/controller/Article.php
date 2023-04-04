<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Session;

class Article extends Controller
{
    public function _initialize()
    {
        // 统计购物车的数量
        $shop_car = Session::get('car');
        $sumcar = empty($shop_car) ? 0 : count($shop_car);
        $this->assign('sumcar',$sumcar);
    }
    
    //显示公告通知
    public function blog()
    {
        //接收id(如果id不存在,直接让进入)
        $id = input('get.id');
        if(empty($id)){
            die;
        }

        //右边热门话题(点击量降序)
        $hot = Db::name('article')
            ->field('title,article_id')
            ->where('state',1)
            ->order('click desc')
            ->limit(10)
            ->select();
        $this->assign('hot',$hot);

        //公告或者特惠详情页
        $detail = Db::name('article')
            ->where('article_id',$id)
            ->select();
        $this->assign('detail',$detail);

        //点击量（阅读数）
        $sql = "update shop_article set click=click+1 where article_id=$id";
        Db::execute($sql);

        // 统计购物车的数量
        if(!empty($_SESSION['car'])){
            $sumcar = count($_SESSION['car']);
            $this->assign('sumcar',$sumcar);
        }else{
            $this->assign('sumcar',0);
        }

     return  $this->fetch();
    }



}