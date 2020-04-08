<?php

namespace App\Model\Admin;

use App\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeCategory extends BaseModel
{

    protected $fillable = [
        'name'
    ];
}
