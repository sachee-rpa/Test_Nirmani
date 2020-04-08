<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminData extends Model
{
    //

  public static function getValue($key){
     return self::select('value')->where('key', $key)->pluck('value')->first();
    }
}