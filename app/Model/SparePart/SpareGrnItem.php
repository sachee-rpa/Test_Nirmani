<?php

namespace App\Model\SparePart;

use App\Enums\Condition;
use App\Enums\Quality; 
use Illuminate\Database\Eloquent\Model;

class SpareGrnItem extends Model
{
    protected $fillable = [
       'spare_grn_id' ,'spare_po_id', 'amount','condition','currency_id','quality',
        'quantity','rate','spare_parts_id','unit_id','sell_price','unit_sell_price'
    ];
    protected $appends = ['condition_name','quality_name','label','available'];
   
    public function getLabelAttribute()
    {
        return  Condition::getKey(intval($this->condition)) 
        .' '.Quality::getKey(intval($this->quality)).' '.$this->available.''.$this->unit->name;           
    }
    
    public function getAvailableAttribute()
    {
        $credit = $this->quantity;
        $debit = SpareInvoiceItems::where('spare_grn_items_id',$this->id)->sum('quantity');     
        $return = 0;
        return  ($credit - $debit)+ $return ;           
    }
    
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
    public function unit()
    {
        return $this->belongsTo('App\Model\Admin\Unit');
    }
}