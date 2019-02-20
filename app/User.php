<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\RolesAdminMenus;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'surname',
        'name',
        'login',
        'date',
        'money',
        'email',
        'password',
        'email_verified_at',
        'remember_token',
        'country_id',
        'language_id',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles() {
        // hasMany - звязок багато до багатьох    через таблицю
        return $this->belongsToMany('App\Role', 'roles_users');
    }

    //                                          свою табл     чужу
    public function country() {
    	return $this->belongsTo('App\Country', 'country_id', 'id');
    }

    public function customer() {
        return $this->hasOne('App\Customer');
    }

    public function language() {
    	return $this->belongsTo('App\Language', 'language_id', 'id');
    }

    // Methods needed for implements JWTSubject interface
    public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
        return [];
    }
    public function getMenu()
    {
        $roles = $this->roles;
        $menuIDs = array();
        foreach($roles as $role){
            $menu_for_role = $role->getMenu;
            foreach ($menu_for_role as $menu){
                $menuIDs[]=$menu->id;
            }
        }

        $menuIDs = array_unique($menuIDs);
       return AdminMenu::where([['disabled', '<>', 1],['root', '=', 1],])->where(function ($query) use ($menuIDs) {
               $query->whereIn('id',$menuIDs);
           })
           ->orderBy('order')->get();
    }
}
