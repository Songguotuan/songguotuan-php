<?php
/**
 * Created by PhpStorm.
 * User: 杨一鸣
 * Date: 2018/7/20
 * Time: 15:31
 */
namespace app\index\model;
use think\Model;
use think\Db;
use app\index\controller\Base;

class Home extends Model
{
    //功能：查询首页轮播广告的url
    //入参：无
    //出参：success: 包含所有轮播广告的url的数组
    public function get_carousel(){
        $result = db('home_ad')->where('status',1)->column('url');
        $base = new Base();
        return ($base -> callback("success",$result));
    }

    //功能：查询收件点信息
    //入参：无
    //出参：success: 包含该校所有收件点信息
    public function fetch_pull($school_id){
//        $data = array('软件园','东苑','西苑');
//        db('school')->where('school_id',$school_id)->update(['rough_address' => $data]);
        $result = db('school')->where('school_id',$school_id)->where('status',1)->column('rough_address');
        $base = new Base();
        $result = json_decode($result[0],JSON_UNESCAPED_UNICODE);
//        echo $result;
//        return  gettype($result);
        return ($base -> callback("success",$result));
    }


    //功能：查询该省下开通的学校
    //入参：无
    //出参：success: 包含该校所有收件点信息
    public function pull_school($user_province_id){
        $result1 = db('school')->where('province_id',$user_province_id)->where('status',1)->column('school_id');
        $result2 = db('school')->where('province_id',$user_province_id)->where('status',1)->column('school');
        array_push($result1,$result2);
        $base = new Base();
        return ($base -> callback("success",$result1));
    }



}