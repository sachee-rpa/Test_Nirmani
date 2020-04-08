<?php

namespace App\Model\Overhead;

use App\BaseModel;
use Illuminate\Database\Eloquent\Model;


class SubAccount extends BaseModel
{

    protected $fillable = [
        'name', 'account_id'
    ];

    public function account()
    {
        return $this->belongsTo('App\Model\Overhead\Account');
    }
}
