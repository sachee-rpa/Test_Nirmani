<?php

namespace App\Model\SparePart;

use App\BaseModel;
 

class SparePo extends BaseModel
{
    protected $fillable = [
        'supplier_id','country_id','date','required_date',
        'quote_number','remarks','total_amount'
    ];
   
    public function items()
    {
        return $this->hasMany('App\Model\SparePart\SparePoItem');
    }

    public function supplier()
    {
        return $this->belongsTo('App\Model\Admin\Supplier');
    }

    public function country()
    {
        return $this->belongsTo('App\Model\Admin\Country');
    }
}