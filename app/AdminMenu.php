<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\RolesAdminMenus;
class AdminMenu extends Model
{
    public $childrensObj=array();

    /*
    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
        $this->getChildrens();
    }
    */

    // connection to the submenu
    public function childrens() {

        return $this->hasMany('App\AdminMenusAdminMenu','admin_menu_id','id')->orderBy('order','asc');
    }
    public function getChildrens(){
        $childrens = $this->childrens;
        $ret = array();

        foreach ($childrens as $children) {
            $parent = $children->parent;
            $ret[] = $parent;

            $this->childrensObj[] = $parent;

            $childrenofchildrens = $parent->childrens;
            if(count($childrenofchildrens) > 0) {
                $parent->getChildrens();
            }
        }

       return $ret;
    }

    // public function languag() {
    // 	return $this->belongsTo('App\Languag', 'languages_id', 'id');
    // }

}
