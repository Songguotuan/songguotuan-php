<?php
/**
 * Created by PhpStorm.
 * User: 杨一鸣
 * Date: 2018/7/15
 * Time: 12:56
 */
namespace app\index\controller;
use think\Controller;
use think\Db;
use app\common\controller\commonSmscode;
class commonBase extends Controller
{
    public function hahaa(){
        return 660;
    }

    //功能：回调函数
    //入参：$result  $msg
    //出参：success:  $result内容  ;     false: $msg内容
    public function callback($result = "false",$msg = ""){
        $callback = array(
            "result" => $result,
            "msg" => $msg
        );
        //将callback内容encode编码成字符串传递回前端
        //跨域访问
        header("Access-Control-Allow-Origin:*");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        return json_encode($callback);
    }

    //功能：通过sessioncode将用户的openid和sessioncode插入到redis设置有效期45天
    //入参：用户$session $openid $session_key
    //出参：无
    public function newsession($sessioncode,$openid,$session_key){
        $array = array("$openid","$session_key");
        $jsona = json_encode($array);
        // 赋值（当前作用域）
        Session::set($sessioncode,$jsona);

//        $redis = new Redis();
//        $redis->connect('127.0.0.1', 6379);
//        $redis->set($sessioncode,$jsona, 5184000);
    }



    //功能：通过sessioncode验证用户的session是否过期
    //入参：用户$session
    //出参：success: $openid  ;    false: false
    public function checksession($session){

        // 取值（当前作用域）
        $jsonb = Session::get($session);

//        $redis = new Redis();
//        $redis->connect('127.0.0.1', 6379);
//        $jsonb = $redis->get($session);

        $array = json_decode($jsonb);
        $openid = $array[0];
        $session_key = $array[1];
        if (empty($openid) && empty($session_key)){
            return false;
//            die(callback("false","session已过期"));
        }else{
            return $openid;
        }
    }

    //功能：登出账户
    //入参：用户$session
    //出参：success: $openid  ;    false: false
    public  function deletesession($session){
        // 取值（当前作用域）
        $jsonb = Session::get($session);
//        $redis = new Redis();
//        $redis->connect('127.0.0.1', 6379);
//        $jsonb = $redis->get($session);

        $array = json_decode($jsonb);
        $openid = $array[0];
        $session_key = $array[1];
        if (empty($openid) && empty($session_key)){
            // 删除（当前作用域）
            Session::delete($session);
//            $redis->del($session);
            return true;
        }else{
            return true;
        }
    }

}