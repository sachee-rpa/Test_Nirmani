<?php

namespace App\Model\Admin;

use App\BaseModel;
use Illuminate\Support\Facades\Storage;

class Employee extends BaseModel
{

    protected $fillable = [
        'name',
        'initial',
        'nic_number',
        'employee_category_id',
        'designation',
        'join_date',
        'day_rate',
        'ot_rate',
        'remark',

    ];
    public function getFileUrlAttribute()
    {
        return Storage::disk('s3')->temporaryUrl(
            $this->file , now()->addMinutes(5)
        );          
    }
    public function employee_category()
    {
        return $this->belongsTo('App\Model\Admin\EmployeeCategory');
    }
}