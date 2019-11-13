<?php
/**
 * Created by PhpStorm.
 * User: bjkim
 * Date: 2018-12-29
 * Time: 04:20
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'member';

    public static function current()
    {
        global $member;
        return self::whereMbId($member['mb_id'])->first();
    }
}