<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/11/3
 * Time: 上午9:31
 */

namespace app\api\controller\v1;
use app\api\controller\Base;

class Cat extends Base
{
    public function index()
    {
        $data = [
            [
                'cat_id' => 1,
                'cat_name' => '栏目'
            ],
            [
                'cat_id' => 2,
                'cat_name' => '首页'
            ],
            [
                'cat_id' => 3,
                'cat_name' => '体育'
            ],
            [
                'cat_id' => 4,
                'cat_name' => '新闻'
            ],

        ]
        ;
        return showJson(1,'success',$data,200);
    }
}