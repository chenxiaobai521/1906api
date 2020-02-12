<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //关联到模型的数据表    
    protected $table = 'p_users'; 
    //关联到模型的数据表的主键id  
    // protected $primaryKey  = ''; 
}
