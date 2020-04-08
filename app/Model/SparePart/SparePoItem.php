<?php

namespace App\Model\SparePart;

use App\Enums\Condition;
use App\Enums\Quality;
use App\BaseModel;
use Illuminate\Database\Eloquent\Model;

class SparePoItem extends BaseModel
{
public $timestamps = false;
protected $fillable = [
    'spare_po_id', 'amount','condition','currency_id','quality',
    'quantity','rate','spare_parts_id'
];

protected $appends = ['condition_name','quality_name'];
   

public function getConditionNameAttribute()
{
    return  Condition::getKey(intval($this->condition));           
}

public function getQualityNameAttribute()
{
    return  Quality::getKey(intval($this->quality));           
}

public function spare_parts()
{
    return $this->belongsTo('App\Model\Admin\SparePart');
}

public function currency()
{
    return $this->belongsTo('App\Model\Admin\Currency');
}

}