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

Route::rule([
    //————user————//
    '/send_code'=>'index/user/send_code',
    '/new_user'=>'index/user/new_user',
    'create_session'=>'index/user/create_session',
    'send_school_id'=>'index/user/send_school_id',
    //————order————//
    'fetch_order'=>'index/order/fetch_order',
    'fetch_order_index'=>'index/order/fetch_order_index',
    'upload_image'=>'index/order/upload_image',
    //————home————//
    'get_carousel'=>'index/home/get_carousel',
    'fetch_pull'=>'index/home/fetch_pull',
    'pull_school'=>'index/home/pull_school'
],'','get|post');


