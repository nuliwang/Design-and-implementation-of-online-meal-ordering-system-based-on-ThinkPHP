<?php
namespace app\backend\controller;
use think\Db;
use think\Request;
use think\Session;

class Shop extends Base
{
    public function index()
    {
        $page = \request()->param('page');
        $this->assign('page', $page);

        $listRows = 15;
        $this->assign('listRows', $listRows);

        //连表查询
        $list = Db::name('merchant')
            ->alias('m')
            ->field('m.*,classify.name as class_name')
            ->join('classify', 'm.class_id=classify.classify_id', 'left')
            ->paginate($listRows);

        $this->assign('list', $list);
        return $this->fetch();
    }

    //添加
    public function add()
    {
        if (Session::get('user')['admin_id'] != 22) {
            header("HTTP/1.1 404 Not Found");
            die;
        }

        if (request()->isPost()) {

            $data = request()->only(['admin_password', 'admin_mobile', 'shop_name', 'class_id', 'email', 'logo', 'introduce']);

            $data['status'] = 0;
            $data['add_time'] = date('Y-m-d H:m:s');

            $check_list = [
                'admin_password' => '商户密码',
                'admin_mobile' => '商户手机',
                'shop_name' => '店铺名称',
                'class_id' => '店铺分类'
            ];

            foreach ($check_list as $k => $v){
                if(empty($data[$k])){
                    returnAjax(0, '请输入'.$v);
                }
            }

            $reg_admin_id = Db::name('admin')
                ->insertGetId([
                    'name'     => $data['shop_name'],
                    'password' => md5($data['admin_password']),
                    'type'     => 2,
                    'mobile'   => $data['admin_mobile'],
                    'email'    => $data['email'],
                    'status'   => 0
                ]);

            $merchant_id = Db::name('merchant')->insertGetId([
                'name' => $data['shop_name'],
                'admin_id'=> $reg_admin_id,
                'class_id' => $data['class_id'],
                'logo' => $data['logo'],
                'add_time' => date('Y-m-d H:m:s'),
                'introduce' => $data['introduce'],
                'status'   => 0
            ]);

            $merchant_list = Db::name('classify')->where('classify_id', $data['class_id'])->value('merchant_list');

            if (empty($merchant_list)){
                Db::name('classify')->where('classify_id', $data['class_id'])->update(['merchant_list' => $merchant_id]);
                returnAjax(200);
            }else{
                $merchant_array = explode(',', $merchant_list);
                if(!in_array($merchant_id, $merchant_array)){
                    $merchant_array[] = $merchant_id;
                    $merchant_list = implode (',',$merchant_array);
                    Db::name('classify')->where('classify_id', $data['class_id'])->update(['merchant_list' => $merchant_list]);
                };
                returnAjax(200);
            }
            returnAjax(0);
        }

        $classify_list = Db::name('classify')->where('status', 1)->select();
        $this->assign('classify_list', $classify_list);
        return $this->fetch();
    }

    //改变状态
    public function change()
    {
        $id = input('id');

        $admin_id = Db::name('merchant')->where('id', $id)->find();
        $admin = Db::name('admin')->where('admin_id', $admin_id['admin_id'])->find();
        //商户表
        if ($admin_id['status'] == 1) {
            $update = ['status' => 0];
        } else {
            $update = ['status' => 1];
        }
        //后台管理员表
        if ($admin['status'] == 1) {
            $updates = ['status' => 0];
        } else {
            $updates = ['status' => 1];
        }
        //更新字段
        $res1 = Db::name('merchant')->where('id', $id)->update($update);
        $res2 = Db::name('admin')->where('admin_id', $admin['admin_id'])->update($updates);
        if ($res1 && $res2) {
            returnAjax(200);
        } else {
            returnAjax(0);
        }

    }

    public function del()
    {
        $params = request()->only('id');
//        $id = input('id');
        $id = $params['id'];

        if (is_array($id)) {
            $cur_admin_id_list = Db::name('merchant')->where('id', 'in', $id)->column('admin_id');//相当于查询，查询不到结果返回空数组
            $res1 = Db::name('merchant')->where('id', 'in', $id)->delete();
            $res2 = Db::name('admin')->where('admin_id', 'in', $cur_admin_id_list)->delete();
        } else {
            $cur_admin_id = Db::name('merchant')->where('id', $id)->value('admin_id');
            $res1 = Db::name('merchant')->where('id', $id)->delete();
            $res2 = Db::name('admin')->where('admin_id',$cur_admin_id)->delete();
        }

//        $admin_id = Db::name('merchant')->where('id',$id)->find();
//        $res2 = Db::name('admin')->where('admin_id',$admin_id['admin_id'])->del();
//        $res1 = Db::name('merchant')->where('id',$id)->delete();

        if ($res1 && $res2) {
            returnAjax(200);
        } else {
            returnAjax(0, '删除商户时发生错误');
        }

    }


}