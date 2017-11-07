<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------




// 应用公共文件
function getCatName()
{

}
function isYesNo($unknown)
{
    if ($unknown == 1)
    {
        return '是';
    }
    else
    {
        return '否';
    }
}
function status($status)
{
    if ($status == 1)
    {
        return '正常';
    }
    else
    {
        return '审核';
    }
}




//返回数据的格式
function showJson($status,$message,$data,$httpCode)
{
    $data = [
        'status' => $status,
        'message' => $message,
        'data' => $data
    ];


    return json($data, $httpCode);
}

