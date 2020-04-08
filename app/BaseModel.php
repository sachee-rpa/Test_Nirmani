<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class BaseModel extends Model
{
    use SoftDeletes;
    protected $hidden = [
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    
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