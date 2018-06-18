<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //购物车
    protected $table = 'weixin_cart';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
