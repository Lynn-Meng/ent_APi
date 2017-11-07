<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/11/2
 * Time: 上午10:38
 */
namespace app\api\controller;
use app\common\lib\Aes;
use app\common\lib\ApiException;
use MongoDB\BSON\Timestamp;
use think\Cache;
use think\Controller;
use think\Request;
use app\common\lib\IAuth;


class Base extends Controller
{
    public $header = null;
    public $user = null;
    public function __construct(Request $request = null)
    {
//        $this->testPhone();
//        $this->checkPhone();
        $this->checkVersion();
        //初始化解密   测试
//        $this->checkSignAuth();

        //初始化加密  测试


//        $this->testSign();
    }
    public function checkSignAuth()
    {
        //获取请求头的数据
        $header = request()->header();
        //基础参数的校验
        if (empty($header['app_type']) || !in_array($header['app_type'],['ios','android']))
        {
            throw new ApiException('app_type错误',400);
        }

        //校验sign签名
        if (!IAuth::checkSignAuth($header))
        {
            throw new ApiException('无权访问',401);
        }
        //设置sign字符串的缓存
        Cache::set($header['sign'],1,config('app.app_sign_cache_time'));

        //时间戳的验证
    }

    //加密 测试
    public function testSign()
    {
        //得到13位的时间戳
        $time = microtime();
        list($t1,$t2) = explode(' ',$time);
        $time13 = $t2 . ceil($t1 * 1000);



        $data = [
            'app_type' => 'ios',
            'version' => 1,
            'did' => 'AEVEE',
            'time' => $time13
        ];
        echo IAuth::setSign($data);
    }
    public function getCatName($data)
    {
        if (is_array($data))
        {
            for ($i = 0; $i < count($data);$i++)
            {
                $data[$i]['cat_name'] = config('app.cat_names')[$data[$i]['catid']];
            }
        }
        else
        {
            $data['cat_name'] = config('app.cat_names')[$data['catid']];
        }
        return $data;
    }
    public function checkVersion()
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


    //测试 加密一个手机号
    public function testPhone()
    {
        $str = '211122';
        print_r((new Aes())->encrypt($str));
    }
    //测试  解密一个手机号
    public function checkPhone($sign)
    {
        $res = (new Aes())->decrypt($sign);
        return $res;
    }

}
