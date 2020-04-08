<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;

class BaseBlueprint extends Blueprint
{
    public function commonFields()
    {
        $this->bigInteger('created_by')->unsigned()->nullable();
        $this->bigInteger('updated_by')->unsigned()->nullable();
        $this->bigInteger('deleted_by')->unsigned()->nullable();
        $this->foreign('created_by')->references('id')->on('users');
        $this->foreign('updated_by')->references('id')->on('users');
        $this->foreign('deleted_by')->references('id')->on('users');
        $this->timestamps();
        $this->softDeletes();
    }
}