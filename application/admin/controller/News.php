<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/10/31
 * Time: 下午2:34
 */
namespace app\admin\controller;

use think\Controller;

class News extends Controller
{
    public function index()
    {
        $res = model('News')->getAllNews();
        return $this->fetch('',[
            'news' => $res
            ]
        );
    }
    public function add()
    {
        if(request()->isPost())
        {
            $data = input('post.');
            $validate = validate('News');
            $res = $validate->scene('add')->check($data);
            if (!$res)
            {
                $this->error($validate->getError());
            }
            else
            {
                $res = model('News')->save($data);
                if (!$res)
                {
                    $this->error('插入失败');
                }
                else
                {
                    $this->success('插入成功');
                }
            }
        }
        return $this->fetch();
    }
    public function delete()
    {
        $id = input('id');
        $res = model('News')->save(['status' => -1],['id' => $id]);
        if (!$res)
        {
            $this->error('删除失败');
        }
        else
        {
            $this->success('删除成功');
        }
    }

}