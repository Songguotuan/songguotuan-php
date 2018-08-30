<?php
/**
 * Created by PhpStorm.
 * User: 杨一鸣
 * Date: 2018/7/21
 * Time: 18:28
 */
namespace app\index\controller;
use think\Controller;
use app\index\controller\Base;
use app\index\model\Order as Orders;
class Order extends Base
{
    //抓取所有订单信息
    public function fetch_order(){
        $order = new Orders();
        $result = $order -> fetch_order();
        return $result;
    }

    //抓取指定订单信息
    public function fetch_order_index(){
        $order = new Orders();
        $result = $order -> fetch_order_index($_POST['index']);
        return $result;
    }

}