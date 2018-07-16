<?php
namespace app\index\controller;
use think\Db;
use think\Controller;
use app\index\model\User;
class Index extends Controller
{
    public function wudi(){
        $user = new User();
        $user = $user -> get_member();
        echo $user;
    }

    public function index()
    {
        $member=new User();
        //model自定义方法的调用
        $resGetName=$member->get_member();
        return $resGetName;
    }

    public function test()
    {
        return '我就是想test';
    }

    public function data()
    {

        $DB=new Db;
        $data = $DB::table("user")->select();
        dump($data);
    }
    public function get()
    {
        $re = User::get(1);
        dump($re);
    }
}
