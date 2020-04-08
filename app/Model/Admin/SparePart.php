<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class SparePart extends Model
{
    use SoftDeletes;
  
    protected $fillable = [
        'name',
        'brand_id',
        'brand_model_id',
        'unit_id',
        'machine_id',
        'part_number',       
        'market_rate',
        'remark',
    ];

    public function brand()
    {
        return $this->belongsTo('App\Model\Admin\Brand');
    }

    public function machine()
    {
        return $this->belongsTo('App\Model\Admin\Machine');
    }

    public function brand_model()
    {
        return $this->belongsTo('App\Model\Admin\BrandModel');
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
