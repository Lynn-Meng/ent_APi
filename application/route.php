<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
//
//return [
//    '__pattern__' => [
//        'name' => '\w+',
//    ],
//    '[hello]'     => [
//        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
//        ':name' => ['index/hello', ['method' => 'post']],
//    ],
//
//];

use think\Route;


Route::resource('train','api/train');

Route::get('time','api/time/index');

Route::get(':ver/cat','api/:ver.cat/index');
Route::get('index','api/index/index');
Route::resource('news','api/news');
Route::get('search','api/news/search');
Route::get('version','api/version/index');
Route::resource(':ver/sendcode','api/:ver.sendcode');
Route::resource(':ver/verify','api/:ver.verify');
Route::resource(':ver/user','api/:ver.user');