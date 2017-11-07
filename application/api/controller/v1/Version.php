<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/11/6
 * Time: 上午9:38
 */
namespace app\api\controller;
class Version extends Base
{
    public function index()
    {

        $header = request()->header();
        $conData['app_type'] = $header['app_type'];
        $conData['version'] = $header['version'];
        $conData['did'] = $header['did'];
        model('Active')->save($conData);

        $version = input('version');
        $res = model('Version')->getVersionByMax();
        $resContent = model('Version')->get(['version' => $res]);
        $content['app_type'] = $resContent['app_type'];
        $content['version'] = $resContent['version'];
        $content['apk_url'] = $resContent['apk_url'];
        $content['update_info'] = $resContent['update_info'];
        $content['is_force'] = $resContent['is_force'];

        if($version < $res)
        {
            if ($content['is_force'] == 1)
            {
                $content['is_update'] = 1;
            }
            else
            {
                $content['is_update'] = 2;

            }
            return showJson(1,'Ok',$content,200);
        }
        else
        {

            $content['is_update'] = 0;
            return showJson(1,'Ok',$content,200);
        }
    }
}