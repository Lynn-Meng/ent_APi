<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/11/2
 * Time: 下午3:19
 */
namespace app\api\controller;
use think\Controller;

class Time extends Controller
{
    public function index()
    {
        return showJson(1,'OK',microtime(),200);
    }
}