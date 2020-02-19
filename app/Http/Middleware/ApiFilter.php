<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redis;

class ApiFilter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $uri=$_SERVER['REQUEST_URI'];
        $ua=$_SERVER['HTTP_USER_AGENT'];
        $md5_uri=substr(md5($uri),5,7);
        $md5_ua=substr(md5($uri),5,7);
        $key=$md5_uri.':'.$md5_ua;
        echo $key;
        echo "<br>";
        $count=Redis::get($key);
        echo "现在的访问次数:".$count;
        echo "<br>";
        $max=env('API_ACCESS_COUNT');
        if($count>$max){
            $time=env('API_TIMEOUT_SECONT');
            Redis::expire($key,$time);
            echo "现在的访问次数超过了上限";die;
        }
        $count=Redis::incr($key);
        echo "当前的访问次数:".$count;echo "<br>";
        return $next($request);
    }
}
