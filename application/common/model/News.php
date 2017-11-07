<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/10/31
 * Time: 下午4:03
 */
namespace app\common\model;
use think\Model;

class News extends Model
{
    public function getAllNews( $origin = 0,$count = 20)
    {
        $data = [
            'status' => 1,
            'is_position' => 1,
        ];
        $order = [
            'listorder' => 'desc',
            'id' => 'desc',
        ];
        $res = $this->where($data)->order($order)->limit($origin,$count)->select();
        return $res;
    }




    public function getAllHeadFigure($count = 6)
    {
        $data = [
            'status' => ['neq',-1],
            'is_head_figure' => 1
        ];
        $order = [
            'listorder' => 'desc',
            'id' => 'desc'
        ];
        $res = $this->where($data)->field(['id','catid','title','image','status'])->order($order)->limit($count)->select();
        return $res;
    }

    //根据catId获取数据
    public function getNewsByCatId($catId,$origin = 0,$count = 20)
    {
        $data = [
            'status' => ['neq',-1],
            'catid' => $catId
        ];
        $order = [
            'listorder' => 'desc',
            'id' => 'desc'
        ];
        $res = $this->where($data)->field(['id','catid','title','image','status'])->order($order)->limit($origin,$count)->select();
        return $res;
    }
    //通过关键字获取数据
    public function getNewsByWord($word,$origin = 0,$count = 20)
    {

        $data = [
            'status' => ['neq',-1],
            'title' => [
                'like',
                '%'.$word.'%'
            ]
        ];
        $order = [
            'listorder' => 'desc',
            'id' => 'desc'
        ];
        $res = $this->where($data)->field(['id','catid','title','image','status'])->order($order)->limit($origin,$count)->select();
        return $res;
    }

    //通过id获取数据
    public function getNewsBuId($id)
    {
        $data = [
            'status' => 1,
            'id' => $id
        ];
        $res = $this->where($data)->field(['id','catid','title','image','status'])->find();
        return $res;
    }

}