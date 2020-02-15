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
Route::prefix('/test')->group(function(){
    Route::get('/redis','TestController@testRedis');
    Route::get('/token','TestController@getAccessToken');
    Route::get('/curl1','TestController@curl1');
    Route::get('/curl2','TestController@curl2');
    Route::get('/guzzle','TestController@guzzle');
});
#+++++++++++++++++++++测试Redis+++++++++++++++++++++++
Route::prefix('/api')->group(function(){
    Route::post('/reg','UserController@reg');
});
