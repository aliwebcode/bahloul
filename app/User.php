<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public $appends = ['time', 'skill', 'lang', 'complete'];

    public function receivesBroadcastNotificationsOn()
    {
        return 'App.User.'.$this->id;
    }

    public function user_education() {
        return $this->hasMany('App\Education')->orderBy('id', 'desc');
    }

    public function user_experience() {
        return $this->hasMany('App\Experience')->orderBy('id', 'desc');
    }

    public function user_portfolio() {
        return $this->hasMany('App\Portfolio');
    }

    public function jobs() {
        return $this->hasMany('App\Job')->latest();
    }

    public function applicants() {
        return $this->hasMany('App\Applicant')->latest();
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

    public function shortlists() {
        return $this->hasMany('App\Shortlist');
    }

    public function getTimeAttribute() {
        return $this->created_at->diffForHumans();
    }

    public function getSkillAttribute() {
        if($this->skills)
            return explode(",", $this->skills);
        else
            return 0;
    }

    public function getLangAttribute() {
        if($this->languages)
            return explode(",", $this->languages);
        else
            return 0;
    }

    public function getCompleteAttribute() {
        $count = 0;
        $edu = 0;
        $exp = 0;
        $cv = 0;
        $portfolio = 0;
        if($this->type == 1) {
            if(!$this->gender) $count++;
            if(!$this->image) $count++;
            if(!$this->job_title) $count++;
            if(!$this->phone) $count++;
            if(!$this->website) $count++;
            if(!$this->birthday) $count++;
            if(!$this->experience) $count++;
            if(!$this->education) $count++;
            if(!$this->category_id) $count++;
            if(!$this->languages) $count++;
            if(!$this->skills) $count++;
            if(!$this->cv) $count++;
            if(!$this->description) $count++;
            if(!$this->country_id) $count++;
            if(!$this->city_id) $count++;
            if(!$this->address) $count++;
            // Check CV
            if(!$this->cv) $cv = 1;
            // Check Education
            if($this->user_education->count() == 0) $edu = 1;
            // Check Experience
            if($this->user_experience->count() == 0) $exp = 1;
            // Check Portfolio
            if($this->user_portfolio->count() == 0) $portfolio = 1;
            return [
                "profile" => $count,
                "edu" => $edu,
                "exp" => $exp,
                "cv" => $cv,
                "portfolio" => $portfolio,
            ];
        } else if ($this->type == 2) {
            if(!$this->image) $count++;
            if(!$this->phone) $count++;
            if(!$this->website) $count++;
            if(!$this->category_id) $count++;
            if(!$this->description) $count++;
            if(!$this->country_id) $count++;
            if(!$this->city_id) $count++;
            if(!$this->company_email) $count++;
            if(!$this->founded_in) $count++;
            if(!$this->company_type) $count++;
            if(!$this->company_size) $count++;
            if(!$this->address) $count++;
            return $count;
        } else if($this->type == 3) {
            if(!$this->image) $count++;
            if(!$this->phone) $count++;
            if(!$this->website) $count++;
            if(!$this->category_id) $count++;
            if(!$this->description) $count++;
            if(!$this->country_id) $count++;
            if(!$this->city_id) $count++;
            if(!$this->address) $count++;
            if(!$this->b_name) $count++;
            if(!$this->b_email) $count++;
            if($this->user_portfolio->count() == 0) $portfolio = 1;
            return [
                "profile" => $count,
                "portfolio" => $portfolio,
            ];
        }
    }

}
