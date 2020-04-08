<?php

namespace App\Model\SparePart;

use App\BaseModel;
use Illuminate\Database\Eloquent\Model;

class SpareGrf extends BaseModel
{
    protected $fillable = [
        'spare_gin_id','date','remarks','total_return_amount'
    ];
    
    public function spare_gin()
    {
        return $this->belongsTo('App\Model\SparePart\SpareGin');
    }
}