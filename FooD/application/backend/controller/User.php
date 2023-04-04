<?php
namespace app\backend\controller;
use think\Db;
use think\Request;

class User extends Base
{
    //用户列表
    public function index()
    {
        $page = \request()->param('page');
        $this->assign('page', $page);

        $listRows = 15;
        $this->assign('listRows', $listRows);

        $list = Db::name('user')->paginate($listRows);
        $this->assign('list',$list);

        return $this->fetch();
    }

    public function add()
    {
        if(request()->isPost()) {
            $data = request()->only(['username', 'password', 'email', 'sex', 'birthday', 'qq', 'mobile', 'head_pic']);
            $data['password'] = md5(rtrim($data['password']));
            $data['status'] = 1;
            $data['reg_time'] = time();

            if(empty($data['username'])){
                returnAjax(0,'请输入用户名');
            }

            if(empty($data['password'])){
                returnAjax(0,'请输入用户名');
            }

            $result = Db::name('user')->insert($data);

            if($result){
                returnAjax(200);
            }else{
                returnAjax(0);
            }
        }

        return $this->fetch();
    }

    //删除用户
    public function del()
    {
//        $id = input('id');

        $params = Request::instance()->param();
        $id = $params['id'];

        if(is_array($id)){
            $result = Db::name('user')->where('user_id','in',$id)->delete();
        }else{
            $result = Db::name('user')->where('user_id',$id)->delete();
        }

        if ($result){
            returnAjax();
        }else{
            returnAjax(0);
        }
    }

}