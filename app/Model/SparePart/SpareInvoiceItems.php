<?php

namespace App\Model\SparePart;

use App\BaseModel;
use Illuminate\Database\Eloquent\Model;

class SpareInvoiceItems extends BaseModel
{
    protected $fillable = [
        'spare_invoice_id','spare_grn_items_id','rate','quantity','amount'  ,'spare_parts_id'
    ];

    
public function spare_parts()
{
    return $this->belongsTo('App\Model\Admin\SparePart');
}
    
}