<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $guarded = [];

    protected $appends =  ['time', 'expire', 'skill'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function applicants() {
        return $this->hasMany('App\Applicant');
    }

    public function country() {
        return $this->belongsTo('App\Country');
    }

    public function city() {
        return $this->belongsTo('App\City');
    }

    public function category() {
        return $this->belongsTo('App\Category');
    }

    public function getTimeAttribute() {
        return $this->created_at->diffForHumans();
    }

    public function getExpireAttribute() {
        if($this->expire_date) {
            $end = Carbon::parse($this->expire_date);
            $current = Carbon::now();
            $length = $current->diffInHours($end, false);
            if($length > 0) {
                if($length > 24) {
                    return number_format($length / 24) . " Days Left";
                } else
                    return $length . " Hours Left";
            }
            else
                return 0;
        } else return -1;
    }

    public function getSkillAttribute() {
        if($this->skills)
            return explode(",", $this->skills);
        else
            return 0;
    }

}
