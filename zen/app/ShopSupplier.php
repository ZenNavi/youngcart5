<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopSupplier extends Model
{
    public $primaryKey = "sp_id";
    public $keyType    = "string";
    public $guarded    = array();
    public $timestamps = false;

}
