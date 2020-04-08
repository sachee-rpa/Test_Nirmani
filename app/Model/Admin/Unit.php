<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Unit extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name'
    ];

    public static function boot()
    {
       parent::boot();
       static::creating(function($model)
       {
           if (Auth::user()) {
            $user = Auth::user();            
            $model->created_by = $user->id;
            $model->updated_by = $user->id;
           }
         
       });
       static::updating(function($model)
       {
        if (Auth::user()) {
            $user = Auth::user();
            $model->updated_by = $user->id; 
           }
          
       });    
               
   }
}
 