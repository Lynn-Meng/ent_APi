<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/11/3
 * Time: 上午10:29
 */
namespace app\api\controller\v1;
use Aliyun\api_demo\SmsDemo;
use app\api\controller\Base;
use app\common\lib\Aliyun;
use app\common\lib\ApiException;
use app\common\MsgAliyun;
use JPush\JPush;
use think\Exception;
use jpush\src\JPush\Client;
use jpush\src\JPush\Exceptions as Exceptions;



class Index extends Base
{
    public function index()
    {
        $conData = input('get.');
        try
        {
            $data = model('News')->getAllHeadFigure($conData['lunboCount']);
        }
        catch (Exception $e)
        {
            throw new ApiException('内部错误',500);
        }



        $contentIndex['lunbo'] = $this->getCatName($data);;


        try
        {
            $dataAll = model('News')->getAllNews($conData['positionCount'],$conData['positionOrigin']);
        }
        catch (Exception $e)
        {
            throw new ApiException('内部错误',500);
        }


        $contentIndex['position'] = $this->getCatName($dataAll);;
        return showJson(1,'success',$contentIndex,200);
    }
    public function pushTest()
    {
        JPush::push('Hello',2);
    }

    public function Yeah()
    {
        $res = Aliyun::getInstanse()->sendSms('18242067048');
        if ($res)
        {
            return showJson(1,'OK',[],200);
        }
        else
        {
            return showJson(0,'ERROR',[],500);
        }

    }
}