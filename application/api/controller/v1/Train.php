<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/11/1
 * Time: 下午3:29
 */

namespace app\api\controller;

use app\common\lib\ApiException;
use think\Controller;
use think\Exception;

class Train extends Base
{
    public function index()
    {
        $data = [
            'name' => 'Peng',
            'age' => 23,
            'content' => '请求我干啥'
        ];
        return showJson(1,'success',$data,200);
    }
    public function save()
    {
        $data = [
            'sss' => 1
        ];

        if ($data['sss'] ==1)
        {
            throw new ApiException('数据错误',400);
        }
    }
    public function read($id)
    {
        $data = [
            'name' => 'Peng',
            'id' => $id,
            'sex' => 'M'
        ];
        return showJson(1,'succsess',$data,200);
    }
}