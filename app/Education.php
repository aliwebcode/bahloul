<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = "education";

    protected $guarded = [];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
