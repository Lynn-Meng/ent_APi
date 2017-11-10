<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/11/7
 * Time: 上午9:43
 */
namespace app\api\controller\v1;
use app\api\controller\Base;
use app\common\lib\Aliyun;
use think\Validate;

class SendCode extends Base
{
    //对应路由的post请求
    public function save()
    {
        //判断是否位POST请求
        if (!request()->isPost())
        {
            return showJson(0,'无效请求',[],400);
        }
        $phone = $this->checkPhone(input('post.phone'));
        //判断电话号码是否符合规范(11位数字)
        $validate = new Validate(['phone' => 'require|number|length:11']);
        if ($validate->check($phone))
        {
            return showJson(0,$validate->getError(),[],400);
        }
        //发送验证码
        $res = Aliyun::getInstanse()->sendSms($phone);
        if ($res)
        {
            return  showJson(1,'ok',[],200);
        }
        else
        {
            return showJson(0,'验证码发送失败',[],201);
        }
    }
}