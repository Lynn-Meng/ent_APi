<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/10/31
 * Time: 下午4:03
 */
namespace app\common\validate;
use think\Validate;

class News extends Validate
{
    protected $rule = [
        'title' => 'require|max:20',
        'small_title' => 'require|max:20',
        'description' => 'require',
        'image' => 'require',
        'content' => 'require',
    ];
    protected $message = [
        'title.require' => '标题不能为空',
        'title.max' => '标题不能超过20个字符',
        'small_title.require' => '简略标题不能为空',
        'small_title.max' => '简略标题不能超过20个字符',
        'description.require' => '文章摘要不能为空',
        'image.require' => '请上传图片',
        'content.require' => '文章内容不能为空'
    ];
    protected $scene = [
        'add' => ['title','small_title','description','image','content']
    ];
}