<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    protected $guarded = [];
    protected $appends = ['time'];

    public function job() {
        return $this->belongsTo('App\Job');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function getTimeAttribute() {
        return $this->created_at->diffForHumans();
    }

}
