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
            echo '有';
            $abc=json_decode($cache,true);
            print_r($abc);
        }else{
            echo '没有';
            $abc=Goods::where('goods_id',$goods_id)->first();
            $abc=json_encode($abc->toArray());
            Redis::set($key,$abc);
            Redis::expire($key,10);
        }
        die;
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
}
