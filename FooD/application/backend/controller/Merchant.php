<?php
namespace app\backend\controller;
use think\Db;
use think\Request;
use think\Session;

class Merchant extends Base
{
    public function index()
    {
        $admin_id = Session::get('user')['admin_id'];

        $list = Db::name('merchant')
            ->alias('m')
            ->field('m.*,classify.name as class_name')
            ->join('classify','m.class_id=classify.classify_id','left')
            ->where('admin_id', $admin_id)
            ->paginate();

        $this->assign('list',$list);

        $uid = session('user')['admin_id'];
        //商户信息
        $detail = Db::name('merchant')->where('admin_id',$uid)->find();
        $this->assign('detail',$detail);
        //菜品分类
        $data = Db::name('classify')->where('status',1)->select();
        $this->assign('data',$data);

        return $this->fetch();
    }

    //编辑菜单
    public function edit()
    {
        if(Request::instance()->isPost()) {
            $param = request()->only(['id','name','status','class_id','introduce'],'post');

            //更新数据
            $merchant_list = Db::name('classify')->where('classify_id', $param['class_id'])->value('merchant_list');
            if (empty($merchant_list)){
                Db::name('classify')->where('classify_id', $param['class_id'])->update(['merchant_list' => $param['id']]);
            }else{
                $merchant_array = explode(',', $merchant_list);//把字符串打撒为数组
                if(!in_array($param['id'], $merchant_array)){
                    $merchant_array[] = $param['id'];
                    $merchant_list = implode(',', $merchant_array);//把数组合为字符串
                    Db::name('classify')->where('classify_id', $param['class_id'])->update(['merchant_list' => $merchant_list]);
                };
            }

            $res = Db::name('merchant')->where('id',$param['id'])->update($param);

            if($res){
                returnAjax(200,'修改成功');
            }else{
                returnAjax(0,'修改失败');
            }
        }

      
        return $this->fetch();
    }

    public function del()
    {
        $params = Request::instance()->param();
//        $id = input('id');
        $id = $params['id'];

        if (is_array($id)){
            $res1 = Db::name('merchant')->where('id','in', $id)->delete();
        } else {
            $res1 = Db::name('merchant')->where('id',$id)->delete();
        }

//        $admin_id = Db::name('merchant')->where('id',$id)->find();
//        $res2 = Db::name('admin')->where('admin_id',$admin_id['admin_id'])->del();
//        $res1 = Db::name('merchant')->where('id',$id)->delete();

        if($res1){
            returnAjax(200);
        }else{
            returnAjax(0, '删除商户发生错误');
        }

    }

}