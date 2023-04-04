<?php
namespace app\backend\controller;
use think\Controller;
use think\Db;
use think\Session;

class Login extends Controller
{
    //登录
    public function login()
    {
         Session::get('type');

        if(request()->isPost()){
            $username = input('username');
            $password = input('password');
            //判断是否存在
            $exist = Db::name('admin')->where('name',$username)->find();
            if(!$exist){
                returnAjax(0,'该用户不存在');
            }
            $result = Db::name('admin')->where('name',$username)->where('password',md5($password))->find();
            if(!$result){
                returnAjax(0,'密码错误，请重试');
            }
            $result2 = Db::name('admin')->where('name',$username)->where('status',1)->where('password',md5($password))->find();

            if(!$result2){
                returnAjax(0,'该账号未通过审核，请联系管理员');
            }else{
                //通过admin查找商户信息
                $merchant = Db::name('merchant')->where('admin_id',$result2['admin_id'])->find();

                Session::set('type',$result2['type']);
                Session::set('user',$result2);
                Session::set('merchant',$merchant);
                returnAjax(200,'登录成功');
            }
        }


        return $this->fetch();
    }

}