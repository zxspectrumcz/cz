<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public function roles() {
        // hasMany - звязок багато до багатьох    через таблицю
        return $this->belongsToMany('App\Role', 'permissions_roles');
    }
}
