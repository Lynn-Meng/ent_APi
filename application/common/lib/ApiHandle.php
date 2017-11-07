<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/11/1
 * Time: 下午4:10
 */
namespace app\common\lib;
use Exception;
use think\exception\Handle;

class ApiHandle extends Handle
{
    public $httpCode = 500;
    //重写父类中的render函数
    public function render(Exception $e)
    {

        if (config('app_debug') == true)
        {
            parent::render($e);
        }

        if ($e instanceof ApiException)
        {


            $this->httpCode = $e->httpCode;

        }
            return showJson(0,$e->getMessage(),[],$this->httpCode);
    }
}