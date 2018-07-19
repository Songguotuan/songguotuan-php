<?php
/**
 * Created by PhpStorm.
 * User: 杨一鸣
 * Date: 2018/7/15
 * Time: 12:47
 */
namespace app\index\controller;
use think\Controller;
use think\Db;
use app\index\controller\Base;


class Smscode extends Base
{
    //验证输入的验证码是否正确
    //入参：用户的phonenumber,$thecode
    //出参：success:ture    ;   false:false
    public function verifycode($phonenumber,$thecode){
        $result = db('smscode')->where('phonenumber',$phonenumber)->where('code',$thecode)->count();
        if ($result > 0){
            return true;
        }else{
            return false;
        }
    }


    //功能：发送短信验证码
    //入参：用户的phonenumber
    //出参：success:发送成功    ;   false:失败原因
    public function sendcode($phonenumber){
        $DB = new Db();
        function to_sendcode($code,$phonenumber){
            $base = new Base();
            $statusStr = array(
                "0" => "短信发送成功",
                "-1" => "参数不全",
                "-2" => "服务器空间不支持,请确认支持curl或者fsocket，联系您的空间商解决或者更换空间！",
                "30" => "密码错误",
                "40" => "账号不存在",
                "41" => "余额不足",
                "42" => "帐户已过期",
                "43" => "IP地址限制",
                "50" => "内容含有敏感词",
                "51" => "手机号码不正确"
            );
            $content = urlencode("【acampus】您的验证码为".$code."，在2分钟内有效");
            $pwd = md5("yym10295");
            $api = "http://api.smsbao.com/sms?u=piaobodewul&p=".$pwd."&m=".$phonenumber."&c=".$content;
            $result = 0;
//            $result =file_get_contents($api) ;
            if($result == 0){
                return($base -> callback("success","发送成功"));
            }else{
                return($base -> callback("false","$statusStr[$result]"));
            }
        }
        $rows1 = db('smscode')->where('phonenumber',$phonenumber)->count();
        //判断此手机号是否发过验证码
        if ($rows1 > 0){
            //发过
            $now_time_end = time() - 120;
            $rows2 = db('smscode')->where('phonenumber',$phonenumber)->where('time_end',$now_time_end)->count();
            //判断是否发送时长是否大于两分钟
            if ($rows2 > 0){
                //小于两分钟
                exit(callback("false","2分钟后重试"));
            }else{
                //大于两分钟
                //避免短信服务器bug所以重新发送相同的验证码
                $oldcode=Db::query("select code from smscode WHERE phonenumber = ".$phonenumber." ");
                $oold=$oldcode[0]['code'];                         //改动啦去掉了引号
                $time_end2 = time();
                $sql3_result = Db::execute("UPDATE smscode SET time_end = ".$time_end2." WHERE phonenumber = ".$phonenumber." ");
                return to_sendcode($oold,$phonenumber);
            }
        }else{
            //未发过
            //发验证码
            $code = rand(100000,999999);
            //发送验证码的时间
            $time_end = time();
            $sql2_result = Db::execute("INSERT into smscode(phonenumber,code,time_end) VALUES ('".$phonenumber."','".$code."','".$time_end."')");
            return to_sendcode($code,$phonenumber);
        }
    }



}