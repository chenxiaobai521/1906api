<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/phpinfo', function () {
    phpinfo();
});
#+++++++++++++++++++++测试Redis+++++++++++++++++++++++
Route::get('/test/redis','TestController@testRedis');
#+++++++++++++++++++++测试Redis+++++++++++++++++++++++
Route::prefix('api/')->group(function(){
    Route::get('/reg','UserController@reg');
});
