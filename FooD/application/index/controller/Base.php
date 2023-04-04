<?php
namespace app\index\controller;
use think\Controller;

class Base extends Controller
{
    //返回json失败信息
    public function sendError($error='失败',$code=0,$data=[])
    {
        returnAjax($code,$error,$data);
    }
    //返回json成功信息
    public function SendSuccess($success='成功',$code=200,$data=[])
    {
        returnAjax($code,$success,$data);
    }

}