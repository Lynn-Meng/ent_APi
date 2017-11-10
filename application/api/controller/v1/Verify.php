<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/11/7
 * Time: 上午10:37
 */
namespace app\api\controller\v1;
use app\api\controller\Base;
use app\common\lib\Aes;
use app\common\lib\IAuth;
use think\Validate;

use think\Cache;

class Verify extends Base
{
    public function save()
    {
        if (!request()->isPost())
        {
            return showJson(0,'无效请求',[],400);
        }
        $phone = $this->checkPhone(input('post.phone'));
        $code = $this->checkPhone(input('post.code'));
        //判断电话号码是否符合规范(11位数字)
        $validate = new Validate(['phone' => 'require|number|length:11']);
        if ($validate->check($phone))
        {
            return showJson(0,$validate->getError(),[],400);
        }
        $validateCode = new Validate(['code' => 'require|number|length:6']);
        if ($validateCode->check($code))
        {
            return showJson(0,$validate->getError(),[],400);
        }
//        print_r(Cache::get('code'));
//        print_r(' ');
//        print_r($code);exit();
        if (Cache::get('code') != $code)
        {
            return showJson(0,'失败',[],201);
        }
        else
        {
            $token = IAuth::setAppAccessToken($phone);
            $data = [
                'token' => $token,
                'time_out' => strtotime('+7days')
            ];
            //根据手机号查询用户信息
            $user = model('User')->get(['phone' => $phone]);
            if (!$user)
            {

                $conData = array();
                $conData = $data;
                $conData['username'] = 'XiGua_'.$phone;
                $conData['password'] = md5('111111');
                $conData['create_time'] = time();
                $conData['update_time'] = time();
                $conData['sex'] = 'M';
                $conData['status'] = '1';
                $conData['phone'] = $phone;
                model('User')->save($conData);
            }
            else
            {
                $user_id = $user['id'];
                $conData = $data;
                $conData['update_time'] = time();
                $conData['status'] = '1';
                model('User')->save($conData,['phone' => $phone]);
            }
            //给前端返回数据  携带token
            //为了安全性  需要对token 进行加密
            $resukt = [
                'token' => (new Aes())->encrypt($token.'||'.$user_id)
            ];
            return showJson(1,'登录成功',$resukt,200);
        }
    }

    public function update()
    {
        $data = input('put.');
        $phone = $this->checkPhone($data['phone']);
        $password = md5($this->checkPhone($data['password']));
        $useranme = $data['username'];
        $sex = $data['sex'];
        //对电话进行校验
        $validate = new Validate(['phone' => 'require|number|length:11']);
        if ($validate->check($phone))
        {
            return showJson(0,$validate->getError(),[],400);
        }
        //校验电话在数据库中是否存在 如果存在 就更新信息 否则添加一条信息
        $res = model('User')->get(['phone' => $phone]);
        $conData['phone'] = $phone;
        $conData['username'] = $useranme;
        $conData['password'] = $password;
        $conData['sex'] = $sex;
        if ($res)
        {

            $result = model('User')->save($conData,['phone' => $phone]);
            if ($result)
            {
                return showJson(1,'数据更新成功',[],200);
            }
            else
            {
                return showJson(0,'数据更新失败',[],201);

            }
        }
        else
        {
            $result = model('User')->save($conData);
            if ($result)
            {
                return showJson(1,'数据新增成功',[],200);
            }
            else
            {
                return showJson(0,'数据新增成功',[],201);

            }
        }

    }
}