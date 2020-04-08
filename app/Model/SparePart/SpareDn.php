<?php

namespace App\Model\SparePart;

use App\BaseModel;
use Illuminate\Database\Eloquent\Model;

class SpareDn extends BaseModel
{
    protected $fillable = [
        'spare_gin_id','date','remarks'
    ];
}