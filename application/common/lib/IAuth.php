<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/11/2
 * Time: 上午11:10
 */
namespace app\common\lib;

use think\Cache;
use think\Exception;

class IAuth {
    //解密sign
    public static function checkSignAuth($data = [])
    {
        if (empty($data['sign']))
        {
            return false;
        }
        //解密sign $aes  = new Aes
        $signStr = (new Aes())->decrypt($data['sign']);

        //将字符串转换为数组
        //app_type=ios&did=34567&version=1 转换为  关联数组


        parse_str($signStr,$arr);



        //用did判断是否合法
        if (!is_array($arr) || empty($arr['did']) || $arr['did'] != $data['did'])
        {
            return false;
        }

//        print_r(time());
//        print_r(' ');
//        print_r($arr['time']/1000);exit();
        //时间戳验证
       if (config('app_debug') != true)
       {
           if (((time()) - ceil($arr['time']/1000)) > config('app.app_sign_time'))
           {
               return false;
           }
           //如果能够获取到sign的缓存  那么说明已经使用sign请求过一次了 所以不具备唯一性  无权访问
           if (Cache::get($data['sign']))
           {
               return false;
           }
       }
        return true;

    }
    //设置sign
    public static function setSign($data = [])
    {
        //加密算法
        //(1). 排序
        ksort($data);
        //(2). 拼接字符串
        $str = http_build_query($data);
        //(3). 加密字符串
        $aesStr = (new Aes())->encrypt($str);

        return $aesStr;
    }

    public static function setAppAccessToken($phone)
    {
        //唯一的一个id
        //microtime(true) 生成当前微秒时间的浮点数
        //使用md5加密微秒数
        //使用uniqid()生成唯一id 第二个参数为true  让id更具有唯一性
        //用md5加密唯一id
        $token = md5(uniqid(md5(microtime(true)),true));
        $token = sha1($token.$phone);
        return $token;
    }
}