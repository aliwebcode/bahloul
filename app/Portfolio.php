<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $guarded = [];

    protected $table = "portfolio";

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function portfolio_images() {
        return $this->hasMany('App\PortfolioImage');
    }

}
