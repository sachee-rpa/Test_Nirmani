<?php

namespace App\Model\SparePart;

use Illuminate\Database\Eloquent\Model;

class SpareGrfItems extends Model
{ 
    protected $fillable = [
    'spare_grf_id','spare_invoice_item_id','return','rate','return_amount'
    ];
}