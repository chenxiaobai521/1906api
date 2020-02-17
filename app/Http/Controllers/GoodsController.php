<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Goods;

class GoodsController extends Controller
{
    public function goods(){
        $goods_id=$_GET['goods_id'];
        // dump($goods_id);die;
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
