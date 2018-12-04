<?php
/**
 * Created by PhpStorm.
 * User: 杨一鸣
 * Date: 2018/7/21
 * Time: 18:28
 */
namespace app\index\model;
use think\Image;
use think\Model;
use think\Db;
use app\index\controller\Base;
class Order extends Model
{
    //功能:抓取所有订单信息
    //入参：
    //出参：success: order信息    ;     false:验证码不正确
    public function fetch_order(){
        $DB = new Db();
        $base = new Base();
        $result = Db::table('order')->field('id,prop_wxavatarurl,prop_wxnickname,type,price,time,rough_address,hope_time')->where('status',1)->select();
        return ($base -> callback("success", $result));
    }

    //功能:抓取指定订单信息
    //入参：index
    //出参：success: order信息    ;     false:验证码不正确
    public function fetch_order_index($index){
        $DB = new Db();
        $base = new Base();
        $result = Db::table('order')->field('id,prop_wxavatarurl,prop_wxnickname,type,price,time,rough_address,hope_time')->where('rough_address_index',$index)->where('status',1)->select();
        return ($base -> callback("success", $result));
    }



}