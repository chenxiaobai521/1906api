<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;

class UserController extends Controller
{
    public function reg(Request $request){
        $userInfo=[
            'user_name' =>  $request->input('user_name'),
            'email'     =>  $request->input('email'),
            'pass'      =>  "123456abc"
        ];
        $id = User::insertGetId($userInfo);
        echo $id;
    }
    public function weather(){
        $location=$_GET['location'];
        $url="https://free-api.heweather.net/s6/weather/now?location=".$location."&key=04ae5be98a2e487daab2fe31a69e559f";
        $arr=file_get_contents($url);
        $data=json_decode($arr);
        print_r($data);
    }
    public function test(){
        $key="1906";   //接收端和发送端的key相同

        $data=$_GET['data'];  //接收的数据
        $sign=$_GET['sign'];  //接收的签名

        //验证签名 前提：需要与发送端使用相同的规则
        $sign2=md5($data.$key);
        echo "接收端计算的签名:".$sign2;
        echo "<br>";echo "<br>";

        //与接收到的签名对比
        if($sign2==$sign){
            echo "验证签名通过  数据完整";
        }else{
            echo "验证签名失败  数据损坏";
        }
    }
}
