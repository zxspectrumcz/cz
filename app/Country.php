<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    // hasMany - звязок до багатьох
    public function users() {
        return $this->hasMany('App\User');
    }

}
