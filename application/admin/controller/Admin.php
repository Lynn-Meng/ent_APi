<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/10/31
 * Time: 下午2:34
 */
namespace app\admin\controller;

use think\Controller;

class Admin extends Controller
{
    public function index()
    {
        return $this->fetch();
    }

    public function add()
    {
        if (request()->isPost())
        {
            $data = input('post.');
            $data['password'] = md5($data['password']);
            $data['status'] = 1;
            $data['last_login_ip'] = '127.0.0.1';
            $data['last_login_time'] = time();
            $data['create_time'] = time();
            $data['update_time'] = time();
            $res = model('AdminUser')->save($data);
            if (!$res)
            {
                $this->error('添加用户失败');
            }
            else
            {
                $this->success('添加用户成功');
            }
        }
        return $this->fetch();
    }
}