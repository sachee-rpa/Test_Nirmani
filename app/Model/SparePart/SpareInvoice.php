<?php

namespace App\Model\SparePart;

use App\BaseModel;
use App\Enums\SparePart\CustomerType;
use App\Enums\SparePart\InvoiceType;
use App\Model\Admin\Company;
use Illuminate\Database\Eloquent\Model;

class SpareInvoice extends BaseModel
{
    protected $fillable = [
      'supplier_id','country_id',  'invoice_type','customer_id','date','customer_po_id',
        'customer_type','mr_number','job_number','vat_percentage',
        'nbt_percentage','vat','nbt','remarks','sub_total','after_discount','discount_percentage','discount','total_amount'
    ];

    protected $appends = ['customer_type_no','invoice_type_no','invoice_label'];


    public function getInvoiceLabelAttribute()
    {
    
        return   $this->id." ".$this->customer->name;           
    }

    public function spare_gins()
    {
        return $this->hasOne('App\Model\SparePart\SpareGin');
    }

    public function items()
    {
        return $this->hasMany('App\Model\SparePart\SpareInvoiceItems');
    }


    public function company()
    {
       //dd("lksjdf");
        //dd($this->belongsTo('App\Model\Admin\Company'));
        
       // dd($posts);
        return Company::all();
    }

    public function customer()
    {
       // dd("lksdfj");
        return $this->belongsTo('App\Model\Admin\Customer','customer_id');
    }

    public function customer_po()
    {
     //  dd("lksdsdsdsfj");
        return $this->belongsTo('App\Model\SparePart\CustomerPo');
    }


    public function getCustomerTypeNoAttribute()
    {
        return   CustomerType::getKey(intval($this->customer_type));           
    }

    public function getInvoiceTypeNoAttribute()
    {

        return   InvoiceType::getKey(intval($this->invoice_type));           
    }
}