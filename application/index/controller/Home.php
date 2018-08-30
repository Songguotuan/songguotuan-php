<?php
/**
 * Created by PhpStorm.
 * User: 杨一鸣
 * Date: 2018/7/20
 * Time: 15:30
 */
namespace app\index\controller;
use think\Controller;
use app\index\controller\Base;
use app\index\model\Home as Homes;
use app\index\controller\Smscode;

class Home extends Base
{
    //查询首页轮播广告的url
    public function get_carousel(){
        $home = new Homes();
        $result = $home -> get_carousel();
        return $result;
    }

    //查询该校所有收件点
    public function fetch_pull(){
        $home = new Homes();
        $result = $home -> fetch_pull($_POST['school_id']);
        return $result;
    }

    //查询该省下开通的学校
    public function pull_school(){
        $home = new Homes();
        $result = $home -> pull_school($_POST['user_province_id']);
        return $result;
    }

}