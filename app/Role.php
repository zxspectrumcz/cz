<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function users() {
        // hasMany - звязок багато до багатьох    через таблицю
        return $this->belongsToMany('App\User', 'roles_users');
    }

    public function perm() {
        // hasMany - звязок багато до багатьох    через таблицю
        return $this->belongsToMany('App\Permission', 'permissions_roles');
    }
    public function getMenu(){
        return $this->belongsToMany('App\AdminMenu','roles_admin_menus');
    }
}
