<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Addrs extends Model
{
    //地址
    protected $table      = 'weixin_addrs';
    protected $primaryKey = 'id';
    public $timestamps    = false;

}
