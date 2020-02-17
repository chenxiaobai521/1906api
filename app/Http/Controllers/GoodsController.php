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
        $data['ua']=$ua;
        $data['ip']=$ip;
        $data['created_at']=$time;
        $count=Goods::where('goods_id',$goods_id)->count();
        if(empty($count)){
            $data['goods_id']=$goods_id;
            $data['pv']=1;
            Goods::create($data);
        }else{
            $count1=Goods::select('ip')->where('goods_id',$goods_id)->count();
            if($count1=0){
                $data['pv']=1;
                Goods::create($data);
            }else{
                $where=[
                    ['goods_id','=',$goods_id],
                    ['ip','=',$ip]
                ];
                Goods::where($where)->increment('pv');
                $uv=Goods::select('ua')->where('goods_id',$goods_id)->count();
                $pv=Goods::sum('pv');
                echo ('uv:'.$uv);
                echo "<br>";
                echo ('pv:'.$pv);
            }
        }
    }
}
