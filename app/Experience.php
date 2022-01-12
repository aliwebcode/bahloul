<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $guarded = [];

    protected $table = "experience";

    public function user() {
        return $this->belongsTo('App\User');
    }

}
