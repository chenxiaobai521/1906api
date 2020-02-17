<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class TestController extends Controller
{
    public function testRedis(){
        $key="1906";
        $val=time();
        Redis::set($key,$val);
        $value=Redis::get($key);
        echo $value;
    }
    public function getAccessToken(){
        $appid='wxfa46b45d559fcbbe';
        $appsecret='7d1e9134214ee8e36d195e30636fc4de';
        $url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$appsecret;
        $abc=file_get_contents($url);
        var_dump($abc);
        $arr=json_decode($abc,true);
    }
    public function curl1(){
        $appid='wxfa46b45d559fcbbe';
        $appsecret='7d1e9134214ee8e36d195e30636fc4de';
        $url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$appsecret;
        //初始化
        $ch=curl_init($url);
        //设置参数选项
        curl_setopt($ch,CURLOPT_HEADER,0);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        //执行会话
		$abc=curl_exec($ch);
		//关闭会话
        curl_close($ch);
        $arr=json_decode($abc,true);
        echo "<pre>";print_r($arr);echo"</pre>";
    }
    public function guzzle(){
        $appid='wxfa46b45d559fcbbe';
        $appsecret='7d1e9134214ee8e36d195e30636fc4de';
        $url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$appsecret;
        $client=new Client();
        $abc=$client->request('GET',$url);
        $data=$abc->getBody();
        echo $data;
    }
    public function curl2(){
        $access_token='30_7nUTqOyxO0HKMqwpvbXkocuft6XWlPJZ7qbTYgkjBzEZ-iFdj9iVNAv9FBR4GDYA2Ok5YnPp7DMy3rRT5LaO0421znlCvLJqjayhXC8w5FpS_sgDMEhKULVRPQc3O6iZvtw9MJGK5JFe0h3BTBEbAEAIQT';
        $url="https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$access_token;
        $menu=[
            "button"=>[
                 ["type"=>"click",
                 "name"=>"CURL",
                 "key"=>"curl1101"
                 ]
            ]
        ];
        //初始化
        $ch=curl_init($url);
        //设置参数选项
        curl_setopt($ch,CURLOPT_HEADER,0);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        //post请求
        curl_setopt($ch,CURLOPT_POST,true);
        //发送json数据
        curl_setopt($ch,CURLOPT_HTTPHEADER,['Content-Type:application/json']);
        curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($menu));
        //执行会话
        $abc=curl_exec($ch);
        //捕获并处理错误
        $errno=curl_errno($ch);
        $error=curl_error($ch);
        if($errno>0){
            echo "错误码:".$errno;echo"<br>";
            echo "错误信息:".$error;die;
        }
		//关闭会话
        curl_close($ch);
        $arr=json_decode($abc,true);
        echo "<pre>";print_r($arr);echo"</pre>";
    }
    public function ceshi1(){
        echo "<pre>";print_r($_POST);echo"</pre>";
    }
    public function ceshi2(){
        echo "<pre>";print_r($_POST);echo"</pre>";
    }
}
