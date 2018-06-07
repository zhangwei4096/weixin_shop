<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    //
    protected $table = 'weixin_shop';
    protected $primaryKey = 'id';
    public $timestamps    = false;
}
