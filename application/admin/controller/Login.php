<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/10/31
 * Time: 下午2:34
 */
namespace app\admin\controller;

use think\Controller;
use think\captcha\Captcha;


class Login extends Controller
{
    public function index()
    {

        return $this->fetch();
    }
    public function check()
    {
        $data = input('post.');
        //数据校验对象生成
        $validate = validate('AdminUser');
        $res = $validate->scene('login')->check($data);
        if (!$res)
        {
            $this->error($validate->getError());
        }

        $res = model('AdminUser')->get(['username'=>$data['username']]);
        if (!$res)
        {
            $this->error('该用户不存在');
        }
        else
        {
            if ($res['password'] !== md5($data['password']))
            {
                $this->error('密码不正确');
            }
            else
            {
                session('loginUser',$res,'mmm');
                $this->success('登录成功','index/index');
            }
        }
    }
    public function logout()
    {
        session('loginUser',null,'mmm');
        $this->redirect('login/index');

    }

}