<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shortlist extends Model
{
    protected $guarded = [];

    protected $appends =  ['time'];

    public function getTimeAttribute() {
        return $this->created_at->diffForHumans();
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function job() {
        return $this->belongsTo('App\Job', 'target_id', 'id');
    }

    public function resume() {
        return $this->belongsTo('App\User', 'target_id', 'id');
    }

    public function company() {
        return $this->belongsTo('App\User', 'target_id', 'id');
    }

    public function business() {
        return $this->belongsTo('App\User', 'target_id', 'id');
    }

//    public function target() {
//        if($this->type == 'job')
//            return $this->belongsTo('App\Job', 'target_id', 'id');
//        else
//            return $this->belongsTo('App\User', 'target_id', 'id');
//    }

    /*
     * Jobs: job - job.user - job.country - job.city - job.category
     * Candidates: user - user.country - user.city - user.category
     * Businesses: b - b.country - b.city - b.category
     * */


}
