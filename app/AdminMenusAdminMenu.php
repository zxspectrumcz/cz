<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminMenusAdminMenu extends Model
{

    protected $table = 'admin_menus_has_admin_menus';
    // sorting the main menu by order
    protected $primaryKey = 'id';
    protected $orderBy = 'order';
    protected $orderDirection = 'asc';

    // link to the menu item 
    public function parent() {
        return $this->belongsTo('App\AdminMenu','admin_child_id');
    }
}

