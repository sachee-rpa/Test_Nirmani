<?php

namespace App\SparePart\Grn;

use App\BaseModel;
use App\Enums\SparePart\GrnCreditMethod;
use Illuminate\Database\Eloquent\Model;

class SpareGrnCredit extends BaseModel
{
    protected $fillable = [
        'credit_method','spare_grn_item_id','spare_parts_id','credit',
        'pending'
    ];


    public static function addGrnCreditGRN($spare_grn_item_id, $spare_parts_id , $credit)
    {
        $grnCredit = self::where('spare_grn_item_id',  $spare_grn_item_id)
        ->where('spare_parts_id',  $spare_parts_id)
        ->where('credit_method',GrnCreditMethod::GRN)->first();
        if ($grnCredit) {
            $grnCredit->credit =  $credit;
            $grnCredit->save();
        }else{
            self::create([
                'credit_method' => GrnCreditMethod::GRN,
                'spare_grn_item_id' => $spare_grn_item_id,
                'spare_parts_id' => $spare_parts_id,
                'credit' => $credit,
                'pending' => 0,              
            ]);
        }
    }   

}