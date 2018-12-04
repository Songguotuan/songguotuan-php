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




    //上传照片
    public function upload_image()
    {

        if (
//            (
                ($_FILES["file"]["type"] == "image/gif")
                || ($_FILES["file"]["type"] == "image/jpeg")
                || ($_FILES["file"]["type"] == "image/jpg")
                || ($_FILES["file"]["type"] == "image/pjpeg")
//            )&& ($_FILES["file"]["size"] < 200000
        ) {
            //时间获取
            $diaryTime = time();
            //获取日期
            $usu_code = rand(10000000,99999999);
            //获取图片后缀如jpg jpeg等
            $thejpg = substr($_FILES['file']['type'],6);
            //存储name
            $file_name=$usu_code.'_'.$diaryTime.'.'.$thejpg;
            //存储path
            $path = "/www/wwwroot/acampus.cn/public/uploads/".$file_name;
//            $_FILES["file"]["name"] = $file_name;
            //存入已有文件夹内
            $judge = move_uploaded_file($_FILES['file']['tmp_name'], $path);
            //保存到指定路径  指定名字
            if ($judge){
                //存储成功
                $res = ['errCode'=>0,'errMsg'=>'图片上传成功','file'=>$file_name,'Success'=>true];
                $base = new Base();
                return ($base -> callback("success", $res));
            }else{//失败
                $res = "Error: ".$_FILES["file"]["error"];
                $base = new Base();
                return ($base -> callback("false", $res));
            }
        }else{
            $base = new Base();
            return ($base -> callback("false", "Invalid file"));
        }
    }


}