<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class TestController extends Controller
{
    public function testRedis(){
        $key="1906";
        $val=time();
        Redis::set($key,$val);
        $value=Redis::get($key);
        echo $value;
    }
}
