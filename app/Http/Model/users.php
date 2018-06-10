<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    //用户表
    protected $table = 'weixin_users';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
