<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //商品表
    protected $primaryKey = 'id';
    protected $table      = 'weixin_product';
    public    $timestamps = false;


}
