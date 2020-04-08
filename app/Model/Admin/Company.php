<?php

namespace App\Model\Admin;

use App\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Company extends BaseModel
{
    protected $fillable = [
        'name',
        'address',
        'tel',
        'fax',
        'email'
      
    ];
}
