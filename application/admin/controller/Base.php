<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/10/31
 * Time: 下午2:34
 */
namespace app\admin\controller;

use think\Controller;

class Base extends Controller
{
    public function index()
    {
        return $this->fetch();
    }

}