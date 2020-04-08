<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class BrandModel extends Model
{
    use SoftDeletes;
   
    protected $fillable = [
        'name','brand_id'
    ];

    public function brand()
    {
        return $this->belongsTo('App\Model\Admin\Brand');
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
