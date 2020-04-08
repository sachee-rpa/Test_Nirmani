<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Supplier extends Model
{

    use SoftDeletes;

    protected $fillable = [
            'name',
            'address',
            'credit_period',
            'credit_limit',
            'country_id',
            'country_id',
            'fixed_line',
            'mobile',
            'fax',
            'email',
            'vat',
            'svat',
            'remark',
    ];

    public function country()
    {
        return $this->belongsTo('App\Model\Admin\Country');
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