<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/11/7
 * Time: 下午3:31
 */
namespace app\api\controller\v1;
use app\api\controller\AuthBase;
use app\common\lib\Aes;

class User extends AuthBase
{
    public function index()
    {
        //为了安全性  需要对用户信息  加密
        $result = [
              'user' => (new Aes())->encrypt($this->user)
        ];
        return showJson(1,'OK',$result,200);
    }
}