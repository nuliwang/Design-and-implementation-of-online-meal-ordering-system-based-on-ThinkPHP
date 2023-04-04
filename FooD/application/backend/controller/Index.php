<?php
namespace app\backend\controller;
use think\Db;
use think\Session;

class Index extends Base
{
    //首页
    public function index()
    {
        //判断是商户还是管理员1管理员2商户
        $type = Session::get('type');
        $this->assign('type',$type);

        return $this->fetch();
    }
    //右侧欢迎页面
    public function welcome()
    {
        return $this->fetch();
    }

}