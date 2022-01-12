<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    public function user() {
        return $this->hasMany('App\User');
    }

    public function jobs() {
        return $this->hasMany('App\Job');
    }

}
