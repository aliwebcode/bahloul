<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PortfolioImage extends Model
{
    protected $guarded = [];

    public function portfolio() {
        return $this->belongsTo('App\Portfolio');
    }

}
