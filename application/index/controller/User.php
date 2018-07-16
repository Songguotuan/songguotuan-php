<?php
/**
 * Created by PhpStorm.
 * User: 杨一鸣
 * Date: 2018/7/10
 * Time: 10:24
 */
namespace app\index\controller;
use think\Controller;
use app\index\controller\Base;
use app\index\model\User as Users;
use app\index\controller\Smscode;

class User extends Base
{

    //发送短信验证码
    public function send_code(){
        $Smscode = new Smscode();
        $result = $Smscode -> sendcode($_POST['phonenumber']);
        return $result;
    }

    //验证用户是否注册 未注册则插入数据库
    public function new_user(){
        $user = new Users();
        $result = $user -> newuser($_POST['session'],$_POST['phonenumber'],$_POST['thecode'],$_POST['wxnickname'],$_POST['wxavatarurl']);
        return $result;
    }



    //生成每个用户的唯一标识并给前端传回session值
    public function create_session(){
        $user = new Users();
        $result = $user -> create_session($_POST['wxuser_code']);
        return $result;
    }



    public function haha(){
        $user = $this->hahaa();
        echo $user;
    }



//    public function tb()
//    {
//        //实例化数据模型
////        $user = new \app\index\model\User;
////        dump($user::get(1));
//        return"ttbb";
//        $DB = new Db;
//
//        $data = $DB::table("user") -> select();
//        return "$data";
//        dump($data);
//    }

}
