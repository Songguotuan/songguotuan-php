<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

//return [
//    '__pattern__' => [
//        'name' => '\w+',
//    ],
//    '[hello]'     => [
//        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
//        ':name' => ['index/hello', ['method' => 'post']],
//    ],
//];
//引入系统类

use think\Route;
//定义路由规则
//Route::rule('路由表达式','路由地址','请求类型','路由参数（数组）','变量规则（数组）');
//Route::rule('/','index/index/index');
//Route::rule('/t','index/index/test');
//Route::rule('/test','index/index/test?index=userinfo');
//
Route::rule([
    '/'=>'index/index/index',
    '/t'=>'index/index/test',
    '/test'=>'index/index/test?index=userinfo'
],'','get|post');

//return[
//    '/'=>'index/index/index',
//    '/t'=>'index/index/test',
//    '/test'=>'index/index/test?index=userinfo'
//];

