<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/11/1
 * Time: 下午4:24
 */

namespace app\common\lib;
use think\Exception;
use Throwable;

//继承的是异常类 重写构造方法
class ApiException extends Exception
{
    public $httpCode = 500;
    public function __construct($message = "",$httpCode, $code = 0, Throwable $previous = null)
    {
        $this->httpCode = $httpCode;
        parent::__construct($message,$code,$previous);
    }
}