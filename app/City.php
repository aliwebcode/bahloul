<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $guarded = [];

    public function user() {
        return $this->hasMany('App\User');
    }

    public function job() {
        return $this->hasMany('App\Job');
    }

}
