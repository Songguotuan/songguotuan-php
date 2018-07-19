<?php
/**
 * Created by PhpStorm.
 * User: 杨一鸣
 * Date: 2018/7/14
 * Time: 0:12
 */
namespace app\index\model;
use think\Model;
use think\Db;
use app\index\controller\Base;
use app\index\controller\Smscode;

class user extends Model
{

    //功能：验证用户是否注册 未注册则插入数据库
    //入参：$session, $phonenumber, $thecode, $wxnickname, $wxavatarurl
    //出参：success:注册成功    ;     false:验证码不正确
    public function newuser($session, $phonenumber, $thecode, $wxnickname, $wxavatarurl){
        $DB = new Db();
        $base = new Base();
        $Smscode = new Smscode();
        $rigistertime = time();
        //$sessioncode是类session的一个实例
        $openid = $base->checksession($session);
        if ($openid == false){
            return false;
        }

        //验证输入的验证码是否正确返回ture，false
        $result = false;
        $result = $Smscode->verifycode($phonenumber, $thecode);
        if ($result) {
            $result2 = db('user')->where('openid',$openid) -> count();
            if ($result2 > 0) {
                return($base -> callback("success", "登录成功"));
            }else{
                DB::query("insert into user (openid,phonenumber,wxnickname,wxavatarurl,registertime) values ('$openid','$phonenumber','$wxnickname','$wxavatarurl','.$rigistertime.')");
                return ($base -> callback("success", "注册成功"));
            }
        } else {
            return ($base -> callback("false", "验证码不正确"));
        }
    }



    //功能：生成每个用户的唯一标识并给前端传回session值
    //入参：微信前端调用api接口生成的wxcode即为$code
    //出参：  success:标识用户的随机数session
    public function create_session($code){
        //向微信服务器发送请求
        $url = "https://api.weixin.qq.com/sns/jscode2session?appid=wx6954d0b6af56a220&secret=fa4ebb5a165604e9a473fbf9ad288108&js_code=$code&grant_type=authorization_code";
        $json_src = file_get_contents($url);
        //将json解码
        $json_src = json_decode($json_src,true);
        $openid = $json_src['openid'];
        $session_key = $json_src['session_key'];
        //生成随机数满足2^128
        //code就是3rd_session
        $code = rand(1000000000,9999999999);//如何生成一个不重复的code值？？？
        //通过sessioncode将用户的openid和sessioncode插入到redis设置有效期15天
        $base = new Base();
        $base -> new_session($code,$openid,$session_key);
        //发送code给前端
        return ($base -> callback("success","$code"));
    }




    public function get_member(){
        return 3;
    }




}