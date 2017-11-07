<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/11/3
 * Time: 下午3:24
 */
namespace app\api\controller;
use app\common\lib\ApiException;
use think\Exception;

class News extends Base
{
    public function index()
    {
        $conData = input('get.');
        if (isset($conData['positionCount']))
        {
            $count = $conData['positionCount'];
        }
        else
        {
            $count = 20;
        }
        if (isset($conData['positionOrigin']))
        {
            $origin = $conData['positionOrigin'];
        }
        else
        {
            $origin = 0;
        }
        $data = model('News')->getNewsByCatId($conData['catid'],$origin,$count);
        $this->getCatName($data);
        $newsContent = $data ;
        return showJson(1,'success',$newsContent,200);
    }

    public function search()
    {
        $conData = input('get.');
        if (isset($conData['positionCount']))
        {
            $count = $conData['positionCount'];
        }
        else
        {
            $count = 20;
        }
        if (isset($conData['positionOrigin']))
        {
            $origin = $conData['positionOrigin'];
        }
        else
        {
            $origin = 0;
        }
        $data = model('News')->getNewsByWord($conData['word'],$origin,$count);
        return showJson(1,'success',$data,200);
    }

    public function read($id)
    {
        try
        {
            $res = model('News')->getNewsBuId($id);
        }
        catch (Exception $e)
        {
            throw new ApiException('获取新闻错误',500);
        }
        model('News')->where(['id' => $id])->setInc('read_count');
        $res = $this->getCatName($res);
        return showJson(1,'success',$res,200);

    }

}