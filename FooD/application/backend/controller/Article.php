<?php
namespace app\backend\controller;
use think\Db;
use think\Request;

class Article extends Base
{
    public function index()
    {
        $page = \request()->param('page');
        $this->assign('page', $page);

        $listRows = 15;
        $this->assign('listRows', $listRows);

        $list = Db::name('article')->paginate($listRows);
        $this->assign('list', $list);
        return $this->fetch();
    }

    //删除
    public function del()
    {
//        $id = input('id');

        $params = Request::instance()->param();
        $id = $params['id'];

        if (is_array($id)) {
            $res = Db::name('article')->where('article_id', 'in', $id)->delete();
        } else {
            $res = Db::name('article')->where('article_id', $id)->delete();
        }

//        $res = Db::name('article')->where('article_id',$id)->delete();

        if ($res) {
            returnAjax(200);
        } else {
            returnAjax(0);
        }
    }

    //添加
    public function add()
    {
        if (request()->isPost()) {
            $data = request()->only(['title', 'content', 'article_imgurl']);
            if (empty($data['title'])) {
                returnAjax(0, '请输入标题');
            }

            if (empty($data['article_imgurl'])) {
                returnAjax(0, '请上传封面图');
            }

            $result = Db::name('article')->insert($data);
            if ($result) {
                returnAjax(200);
            } else {
                returnAjax(0);
            }
        }
        return $this->fetch();
    }

    //编辑
    public function edit()
    {
        $id = input('id');
        $data = Db::name('article')->where('article_id', $id)->find();
        $this->assign('data', $data);
        if (request()->isPost()) {
            $param = request()->only(['id', 'title', 'article_imgurl', 'content'], 'post');
            $param['content'] = trim($param['content']);

            $id = $param['id'];
            unset($param['id']);

            if (empty($param['article_imgurl'])) {
                returnAjax(0, '请确认图片路径');
            }

            $result = Db::name('article')->where('article_id', $id)->update($param);
            if ($result) {
                returnAjax(200, '编辑成功');
            } else {
                returnAjax(0, '编辑失败');
            }
        }
        return $this->fetch();
    }
}