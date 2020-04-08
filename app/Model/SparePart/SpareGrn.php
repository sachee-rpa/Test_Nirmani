<?php

namespace App\Model\SparePart;

use App\BaseModel;
use Illuminate\Database\Eloquent\Model;

class SpareGrn extends BaseModel
{
    protected $fillable = [
        'supplier_id','country_id','date','required_date',
        'quote_number','remarks','total_amount',"invoice_number", "total_sell_amount"
    ];

    public function items()
    {
        return $this->hasMany('App\Model\SparePart\SpareGrnItem');
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