<?php

namespace App\Model\SparePart;

use App\BaseModel;
use Illuminate\Database\Eloquent\Model;

class SpareGin extends BaseModel
{
    protected $fillable = [
        'spare_invoice_id','date','remarks'
    ];

    protected $appends = [ 'gin_label'];
    
    public function spare_dns()
    {
        return $this->hasOne('App\Model\SparePart\SpareDn');
    }

    public function spare_grfs()
    {
        return $this->hasOne('App\Model\SparePart\SpareGrf');
    }


    public function spare_invoice()
    {
        return $this->belongsTo('App\Model\SparePart\SpareInvoice');
    }

    public function getGinLabelAttribute()
    {
        return   "GIN #".$this->id." | Inv #".$this->spare_invoice->id." Customer : ".$this->spare_invoice->customer->name ;           
    }

}