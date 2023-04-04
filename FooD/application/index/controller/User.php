<?php
namespace app\index\controller;
use lib\Phone;
use think\Cache;
use think\captcha\Captcha;
use think\Controller;
use think\Db;

use think\Request;
use think\Session;
use app\index\validate\Email;
use app\index\validate\Mobile;

class User extends Base
{
    //用户登录页面
    public function login()
    {
        return $this->fetch();// 不带任何参数 自动定位当前操作的模板文件
    }


    //手机登录页面
    public function phone()
    {
        return $this->fetch();// 不带任何参数 自动定位当前操作的模板文件
    }

    //==================================================
    //验证用户的登录
    public function doLogin()
    {
        //接收用户输入的数据
        $params = request()->only(['username', 'password', 'captcha']);

//        $name = trim(input('post.username')) ;
//        $password = trim(input('post.password')) ;
//        $code = trim(input('post.captcha')) ;

        $name = $params['username'];
        $password = $params['password'];
        $code = $params['captcha'];
        $username_type = 'username';

        //检验验证码是否正确
        $captcha = new Captcha();
        $res = $captcha->check($code);
        if ($res === false) {
            $this->sendError('验证码错误');
        }

        //判断用户输入是否合法
        if(empty($name)){
           $this->sendError('用户名不能为空');
        }

        $pattern_phone = '/^0?(13|14|15|17|18|19|16)[0-9]{9}$/';
        if(preg_match($pattern_phone, $params['username'])){
            $username_type = 'mobile';
        }

        $pattern_email = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/';
        if(preg_match($pattern_email, $params['username'])){
            $username_type = 'email';
        }

        //验证此用户是否存在
        $user_info = Db::name('user')
                ->where($username_type,$name)
                ->find();


        if(!$user_info){
            $this->sendError('用户名或密码错误，请重试');
        }

        //验证用户名和密码是否正确
        $password1 = md5($password);
        $sql1 = "select * from shop_user where $username_type='$name' and password='$password1'";
        $re = Db::query($sql1);

        //登录成功，保存用户的名字和id
        if($re){
            $uid = $re[0]['user_id'];
            // 初始化购物车
            $session_car = [];
            $shop_car = Db::name('car')
                ->where('user_id', '=', $uid)
                ->find();
            // 如果没有购物车数据
            if(empty($shop_car)){
                // 创建 Session car
                Session::set('car', $session_car, 'think');

                // 在表里插入数据
                Db::name('car')->insert([
                    'user_id'    => $uid,
                    'goods_info' => ''
                ]);
            } else {
                //取出购物车里面商品信息
                if(!empty($shop_car['goods_info'])){
                    $session_car = json_decode($shop_car['goods_info'], true);
                }
            }

            Session::set('username',$re[0]['username']);
            Session::set('id', $uid);
            Session::set('car', $session_car, 'think');
            $this->SendSuccess('登录成功');
        }else {
            $this->SendError('用户名或密码错误，请重试');
        }
    }


    //==================================================
    //验证手机用户的登录
    public function phoneLogin()
    {
        //接收用户输入的数据
        $phone = trim(input('post.phone')) ;
        $code = trim(input('post.code')) ;
        //判断用户输入是否合法
        if(empty($phone)){
            $this->sendError('手机不能为空');
        }
        //验证此用户是否存在
        $result = Db::name('user')
            ->where('mobile',$phone)
            ->find();
        if(!$result){
            $this->sendError('手机号并未注册，请重试');
        }
        //验证验证码
        if(!Cache::get('login'.$phone)){
            $this->sendError('验证码未发送或已失效');
        }
        if($code!=Cache::get('login'.$phone)){
            $this->sendError('验证码错误，请重试');
        }
        //登录成功，保存用户的名字和id
        if($result){
            Session::set('username',$result['username']);
            Session::set('id',$result['user_id']);
            $this->SendSuccess('登录成功,正在跳转...');
        }else {
            $this->SendError('密码错误，请重新输入');
        }
    }



    //用户注册页面======================================================================================
    public function register()
    {
        return $this->fetch();
    }


    //商户注册页面=====================================================================================
    public function mobile_register()
    {
        $data = Db::name('classify')->where('status',1)->select();
        $this->assign('data',$data);
        return $this->fetch();
    }

    public function loginout()
    {
        Session::clear();
        $this->success('退出成功','/');
    }

    //商户注册
    public function merchant()
    {
        $param = input();
        if(!$param['name']){
            $this->SendError('商户名称不能为空');
        }
        if(Db::name('admin')->where('name',$param['name'])->find()){
            $this->SendError('该商户名字已注册，请换个名称');
        }

        if(!$param['logo']){
            $this->SendError('商户logo不能为空');
        }
        if(!$param['class_id']){
            $this->SendError('请选择商家分类');
        }
        if(!preg_match('/^0?(13|14|15|17|18|19|16)[0-9]{9}$/',$param['phone'])){
            $this->SendError('手机号码有误');
        }
        if(empty($param['code'])){
            $this->SendError('验证码未输入');
        }
        if(empty($param['password'])){
            $this->SendError('密码不能为空');
        }
        if(!isPassword($param['password'])){
            $this->SendError('密码为6-16位，只能是数字、字母、下划线');
        }

        if($param['code']!=Cache::get('register'.$param['phone'])){
            $this->SendError('手机验证码错误');
        }
        if($param['password']!=$param['repassword']){
            $this->SendError('两次密码不一致');
        }
        
        $regId = Db::name('admin')
            ->insertGetId(
                [
                    'name'=>$param['name'],
                    'password'=>md5($param['password']),
                    'type'=>2,
                    'mobile'=>$param['phone']
                ]
            );
        //注册商户表
        $res = Db::name('merchant')
            ->insert([
                'name'=>$param['name'],
                'admin_id'=>$regId,
                'class_id'=>$param['class_id'],
                'status'=>0,
                'logo'=>$param['logo'],
                'add_time'=>getTime(),
                'update_time'=>getTime()
            ]);
        if($res){
            $this->SendSuccess('注册成功');
        }else{
            $this->sendError('注册失败');
        }


    }
    //普通用户注册
    public function registerUser()
    {
        $param = input();
        if(!$param['username']){
            $this->SendError('用户名不能为空');
        }

        if(preg_match_all('/^(?![^a-zA-Z]+$)(?!\D+$).{6,}$/',$param['username']) != 1){
            $this->SendError('用户名只能包含字母和数字且长度大于6');
        }

        if(!preg_match('/^0?(13|14|15|17|18|19|16)[0-9]{9}$/',$param['phone'])){
            $this->SendError('手机号码有误');
        }
        if(empty($param['code'])){
            $this->SendError('验证码不能为空');
        }
        $cacheCode =Cache::get('register'.$param['phone']);
        if(empty($cacheCode)){
            $this->SendError('手机验证码已失效或未发送');
        }
        if($param['code']!=$cacheCode){
            $this->SendError('手机验证码错误');
        }
        if(empty($param['password'])){
            $this->SendError('密码不能为空');
        }
        if(!isPassword($param['password'])){
            $this->SendError('密码为6-16位，只能是数字、字母、下划线');
        }
        if($param['password']!=$param['repassword']){
            $this->SendError('两次密码不一致');
        }

        //检查该用户是否存在
        $res = Db::name('user')
            ->where('username',$param['username'])
            ->find();

        if($res){
            $this->SendError('该用户名已注册，请换个用户名');
        }

        if(Db::name('user')
            ->where('mobile',$param['phone'])
            ->find()){
            $this->SendError('该手机号码已绑定，请换个手机号码');
        }

        //写入数据库
       $result = Db::name('user')->insert([
                'username'=>$param['username'],
                'password'=>md5($param['password']),
                'mobile'=>$param['phone'],
                'reg_time'=>time(),
            ]);
        if($result){
            $this->SendSuccess('注册成功，正在跳转登录...');
        }else{
            $this->sendError('注册失败');
        }

    }



    //上传图片
    public function upload()
    {
        $file = request()->file('photo');
        //上传回调error为0
        if (empty($file)) {
            $result["error"] = "1";
            $result['data'] = '';
        } else {
            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads/photo');
            if ($info) {
                $name_path = $info->getSaveName();
                //成功上传后 获取上传信息
                $name_path = str_replace('\\', "/", $info->getSaveName());
                $result["msg"] = '上传成功';
                $result["code"] = '1';
                $result['data'] = "/uploads/photo/" . $name_path;
            } else {
                // 上传失败获取错误信息
                $result["msg"] = '上传失败';
                $result["code"] = "0";
                $result['data'] = '';
            }
        }
       returnAjax(1,'上传成功',$result);
    }

    }