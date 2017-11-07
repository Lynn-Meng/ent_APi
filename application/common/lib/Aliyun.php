<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/11/7
 * Time: 上午9:04
 */
namespace app\common\lib;
use Aliyun\api_demo\SmsDemo;
use think\Cache;
use think\Exception;
use think\Log;

class Aliyun
{
    //单例  单个实例
    /**
     * 私有变量  存储Aliyun类的实例
     * @var null
     * 如果想让类调用  加static
     */
    private static $_instanse = null;

    /**
     * 私有的构造方法  不让外界调用
     * Aliyun constructor.
     *
     */
    private function __construct()
    {

    }
    public static function getInstanse()
    {
        if (self::$_instanse == null)
        {
            self::$_instanse = new Aliyun();
        }
        return self::$_instanse;
    }

    /**
     *  获取验证码
     * @param int $phone 手机号
     */
    public function sendSms($phone = 0)
    {
//        try
//        {
//            $code = rand(100000,1000000);
//            $result = SmsDemo::sendSms(
//                '源文科技',
//                'SMS_109405011',
//                $phone,
//                Array(
//                    'code' => $code
//                )
//            );
//        }
//        catch (Exception $e)
//        {
//            //将错误记录到日志中
//            Log::write('aliyun:send error------------'.$e->getMessage());
//            return false;
//        }
//        if ($result->Code != 'OK')
//        {
//            print_r($result->Code);
//            Log::write('aliyun:send error------------'.$result->Code);
//            return false;
//        }
//        else
//        {
//            Cache::set('code',$code,60);
//            return true;
//        }
        Cache::set('code',211122,60);
        return true;

    }
}
