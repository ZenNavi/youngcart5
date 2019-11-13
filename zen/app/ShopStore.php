<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopStore extends Model
{
    protected $primaryKey = 'st_id';
    protected $keyType    = 'string';
    public $timestamps    = false;
}
