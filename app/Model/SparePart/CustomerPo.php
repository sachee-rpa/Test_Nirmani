<?php

namespace App\Model\SparePart;

use App\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class CustomerPo extends BaseModel
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'customers_id'
    ];

    public function customer()
    {
        return $this->belongsTo('App\Model\Admin\Customer', 'customers_id');
  
    }
}
