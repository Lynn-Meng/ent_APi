<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/11/6
 * Time: 上午9:53
 */
namespace app\common\model;
use think\Model;

class Version extends Model
{
    public function getVersionByMax()
    {
        $res = $this->max('version');
        return $res;
    }
    public function getVerDateByVersion($version)
    {
        $data =
            [
                'version' => $version
            ];
        return $this->where($data)->find();
    }
}