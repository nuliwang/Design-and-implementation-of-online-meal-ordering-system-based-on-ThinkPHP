<?php
namespace app\index\controller;
use think\Request;
use think\Db;
use think\Session;

class Merchant extends Base
{
    public function _initialize()
    {
        // 统计购物车的数量
        $shop_car = Session::get('car');
        $sumcar = empty($shop_car) ? 0 : count($shop_car);
        $this->assign('sumcar',$sumcar);
    }

    public function index()
    {
        $id = input('id');

        //经典套装（销量最高的食品）
        $recommend3 = Db::name('goods')
            ->order('comment_count desc')
            ->where('merchant_id',$id)
            ->select();
        //查询商家
        $data = Db::name('merchant')
            ->where('id',$id)
            ->find();
        $this->assign('data',$data);

        $this->assign('recommend3', $recommend3);
        return $this->fetch();
    }

    /**
     * shops 显示商家页面
     */
    public function shops(){
        // default => 综合排序
        // comment => 好评排序
        // sales   => 销量排序

        $sort = request()->param('sort', 'default');
        return $this->show_shops('', $sort);
    }

    /**
     * searchs 显示商家搜索结果
     */
    public function searchs()
    {
        // 接收查询的关键字(保存在session，方便排序)
        $keys = trim(request()->param('keys', '')) ;
        $sort = request()->param('sort');

        if(empty($sort)){
            // 如果排序为空，则设置关键词
            Session::set('search_shop',$keys);
        } else{
            // 如果接收到排序，则关键字从session读取
            $keys = Session::get('search_shop');
        }

        $this->assign('searchKeys',$keys);
        return $this->show_shops($keys, $sort);
    }

    /**
     * searchs 显示商家搜索结果
     * @param $keywords String 模糊搜索关键字
     * @param $sort String 排序方式
     * @return mixed 渲染模板
     */
    public function show_shops($keywords='', $sort)
    {
        // 默认排序
        if(empty($sort)) $sort = 'default';

        // 根据排序方式生成数据
        switch($sort)
        {
            case 'default':
                $shops = Db::name('merchant')->alias('m')
                    ->where('m.status',1)
                    ->where('m.name','like',"%$keywords%")
                    ->field('m.*,classify.name as class_name')//商家排序上的标签分类
                    ->join('classify','m.class_id=classify.classify_id','left')
                    ->order('id', 'desc')
                    ->paginate([
                        'list_rows' => 15,
                        'query'     => request()->param()
                    ]);
                break;
            case 'comment':
                $shops = Db::name('merchant')->alias('m')
                    ->where('m.status',1)
                    ->where('m.name','like',"%$keywords%")
                    ->join('goods g','m.id=g.merchant_id', 'left')
                    ->join('comment c','g.goods_id=c.goods_id', 'left')
                    ->join('classify','m.class_id=classify.classify_id','left')
                    ->field('m.*,count(g.goods_id) as com_count,c.goods_rand,classify.name as class_name')
                    ->group('m.id')
                    ->order('com_count', 'desc')
                    ->paginate([
                        'list_rows' => 15,
                        'query'     => request()->param()
                    ]);
                break;
            case 'sales':
                $shops = Db::name('merchant')->alias('m')
                    ->where('m.status',1)
                    ->where('m.name','like',"%$keywords%")
                    ->join('goods g','m.id=g.merchant_id', 'left')
                    ->join('classify','m.class_id=classify.classify_id','left')
                    ->field('m.*,g.status as good_status,classify.name as class_name,sum(g.sales_count) as sales_sum')
                    ->group('m.id')
                    ->order('sales_sum', 'desc')
                    ->paginate([
                        'list_rows' => 15,
                        'query'     => request()->param()
                    ]);
                break;
            default:
                $shops = '';
                $page = '';
        }

        // dump(json($shops));die;
        // return json($shops);

        if(!empty($shops)) {
            // 获取分页显示
            $page = $shops->render();
        }

        $this->assign('page', $page);
        $this->assign('shops', $shops);
        $this->assign('shops_count', $shops->total());
        $this->assign('sort', $sort);

        return $this->fetch();
    }

}