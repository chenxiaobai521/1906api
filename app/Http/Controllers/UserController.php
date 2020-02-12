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
}
