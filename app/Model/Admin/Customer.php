<?php

namespace App\Model\Admin;

use App\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends BaseModel
{

    protected  $fillable = [
        'name',
        'address',
        'vat',
        'svat',
        'fixed_line',
        'mobile',
        'fax',
        'email',
        'credit',
        'spare',
        'machinery',
        'service',
        'discount',
        'remark'
    ];

    

}