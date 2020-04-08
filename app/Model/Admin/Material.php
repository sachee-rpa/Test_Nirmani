<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Material extends Model
{
    use SoftDeletes;
  
    protected $fillable = [
       'name',
       'brand_id',   
       'unit_id',      
       'market_rate',
       'remark',
    ];

    public function brand()
    {
        return $this->belongsTo('App\Model\Admin\Brand');
    }

    public function unit()
    {
        return $this->belongsTo('App\Model\Admin\Unit');
    }

   

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (Auth::user()) {
                $user = Auth::user();
                $model->created_by = $user->id;
                $model->updated_by = $user->id;
            }
        });
        static::updating(function ($model) {
            if (Auth::user()) {
                $user = Auth::user();
                $model->updated_by = $user->id;
            }
        });
    }
}
