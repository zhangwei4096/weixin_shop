<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //订单模型
    protected $table = 'weixin_order';
    protected $primaryKey = 'id';
    public    $timestamps = false;
}
