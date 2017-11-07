<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/11/6
 * Time: 下午4:16
 */
namespace app\common;


use aliyun\api_demo\SmsDemo;
use think\Exception;

class MsgAliyun {
    public static function sendMsg($phoneNumber)
    {
        $sign = '源文科技';
        $code = 'SMS_109405011';
        $geter = $phoneNumber;
        $arrat = array('code' => rand(100000,1000000));
        $number = 222;
        try
        {
            SmsDemo::sendSms($sign,$code,$geter,$arrat,$number);
        }
        catch (Exception $e)
        {
            return false;
        }
        return true;


    }
}