<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Model\Goods;

class GoodsController extends Controller
{
    public function goods(){
        $goods_id=$_GET['goods_id'];
        // dump($goods_id);die;
        $key=$goods_id;
        echo 'redis:'.$key;echo '<br>';
        $cache=Redis::get($key);
        if($cache){
            echo '有';echo '<br>';
            $abc=json_decode($cache,true);
            print_r($abc);
        }else{
            echo '没有';
            $abc=Goods::where('goods_id',$goods_id)->first();
            $abc=json_encode($abc->toArray());
            Redis::set($key,$abc);
            Redis::expire($key,10);
        }
        $ip=$_SERVER['REMOTE_ADDR'];
        $ua=$_SERVER['HTTP_USER_AGENT'];
        $time=time();
        // dump($ua);die;
        $data=[
            'goods_id'=>$goods_id,
            'ua'=>$ua,
            'ip'=>$ip,
            'created_at'=>$time,
        ];
        Goods::create($data);
        $pv=Goods::where('goods_id',$goods_id)->count();
        $uv=Goods::where('goods_id',$goods_id)->distinct('ua')->count('ua');
        echo ('pv:'.$pv);
        echo "<hr>";
        echo ('uv:'.$uv);
    }
    public function count(){
        $max=env('API_ACCESS_COUNT');
        $key="abc";
        $number=Redis::get($key);
        if($number>$max){
            $time=env('API_TIMEOUT_SECONT');
            Redis::expire($key,$time);
            echo "现在的访问次数超过了上限";die;
        }
        $count=Redis::incr($key);
        echo $count;echo "<br>";
        echo "访问正常";
    }
}
