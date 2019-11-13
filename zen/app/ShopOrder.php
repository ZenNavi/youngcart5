<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopOrder extends Model
{
    protected $table = 'shop_order';
    protected $primaryKey = 'od_id';
    protected $keyType = 'int';
}
