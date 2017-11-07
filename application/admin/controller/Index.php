<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/10/31
 * Time: 下午2:34
 */
namespace app\admin\controller;

use think\Controller;

class Index extends Controller
{
    public function index()
    {
        if (!session('loginUser','','mmm'))
        {
            $this->redirect('login/index');
        }
        print_r(session('loginUser','','mmm'));
        return $this->fetch();
    }
    public function welcome()
    {
        return '欢迎欢迎 , 热烈欢迎！';
    }
}