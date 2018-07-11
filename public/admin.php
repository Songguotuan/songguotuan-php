<?php
/**
 * Created by PhpStorm.
 * User: 杨一鸣
 * Date: 2018/7/10
 * Time: 15:17
 */
// [ 应用入口文件 ]

// 定义应用目录
define('APP_PATH', __DIR__ . '/../application/');
//绑定后台
define('BIND_MODULE','admin');
// 加载框架引导文件
require __DIR__ . '/../thinkphp/start.php';
//// 关闭路由
\think\App::route(false);