<?php
namespace app\backend\controller;
use think\Db;

class Goods extends Base
{
    public function index()
    {
        $page = \request()->param('page');
        $this->assign('page', $page);

        $listRows = 10;
        $this->assign('listRows', $listRows);
        
        //菜单列表
        $list = Db::name('goods')->where('merchant_id',session('merchant')['id'])->paginate($listRows);
        $this->assign('list',$list);
        return $this->fetch();
    }

    //添加菜品
    public function add()
    {
        if(request()->isPost()){
            $param = request()->only(['good_name','imgpath','market','price','detail','desc','status','repertory'],'post');
            if(empty($param['imgpath'])){
                returnAjax(0,'请上传菜品图片');
            }

            if(!is_numeric($param['market'])){
                returnAjax(0,'原价只能是数字，保留两位小数');
            }
            if(!is_numeric($param['price'])){
                returnAjax(0,'现价只能是数字，保留两位小数');
            }
            $uid = session('user')['admin_id'];
            //商户信息
            $class_id = Db::name('merchant')->where('admin_id',$uid)->find();
            $param['classify_id'] = $class_id['class_id'];
            $param['merchant_id'] = $class_id['id'];
            $result = Db::name('goods')->insert($param);
            if($result){
                returnAjax(200,'添加成功');
            }else{
                returnAjax(0,'添加失败');
            }

        }

        return $this->fetch();
    }

    //删除
    public function del()
    {
        $id = input('id');
        $result = Db::name('goods')->where('goods_id',$id)->delete();
        if ($result){
            returnAjax();
        }else{
            returnAjax(0);
        }
    }
    //编辑
    public function edit()
    {
        $id = input('id');
        $data = Db::name('goods')->where('goods_id', $id)->find();
        $this->assign('data', $data);
        if (request()->isPost()) {
            $param = request()->only(['good_name', 'imgpath', 'market', 'price', 'detail', 'desc', 'status', 'repertory', 'goods_id'], 'post');
            $param['detail'] = trim($param['detail']);
            if (empty($param['imgpath'])) {
                returnAjax(0, '请上传菜品图片');
            }
            if (!is_numeric($param['repertory'])) {
                returnAjax(0, '库存是数字');
            }
            if (!is_numeric($param['market'])) {
                returnAjax(0, '原价只能是数字，保留两位小数');
            }
            if (!is_numeric($param['price'])) {
                returnAjax(0, '现价只能是数字，保留两位小数');
            }
            $uid = session('user')['admin_id'];

            //商户信息
            $class_id = Db::name('merchant')->where('admin_id', $uid)->find();
            $param['classify_id'] = $class_id['class_id'];
            $param['merchant_id'] = $class_id['id'];
            $result = Db::name('goods')->where('goods_id', $param['goods_id'])->update($param);
            if ($result) {
                returnAjax(200, '编辑成功');
            } else {
                returnAjax(0, '编辑失败');
            }
        }
        return $this->fetch();
    }


}