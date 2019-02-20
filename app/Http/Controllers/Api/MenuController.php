<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AdminMenu;
use App\AdminMenusAdminMenu;

class MenuController extends Controller {
    /**
     * Create a new MenuController instance.
     *
     * @return void
     */
    protected $menuToRoleArr = array();
    protected $roleId = false;
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(Request $request) {
        $ret = array();
        $menus = auth()->user()->getMenu();
        foreach($menus as $menuItem){

             $childrens = $this->get_childrens($menuItem);
             if (count($childrens)) {
                $ret[] = array_merge($menuItem->toArray(), [
                    'submenu' => $childrens
                ]);
             } else {
                $ret[] = $menuItem->toArray();
             }
        }

        return response()->json($ret);
    }
    public function index_tmp(Request $request) {
        $roleId = $request->get('role_id');
        $ret = array();

        if ($roleId) {
            $menus = AdminMenu::where([
                ['root', '=', 1],
                ['roles_id', '=', $roleId],
                ['disabled', '<>', 1]
            ])->orderBy('order')->get();
        }
        else {
            $menus = AdminMenu::where('root',1)->orderBy('order')->get();
        }

        foreach($menus as $menuItem) {
            $childrens = $this->get_childrens($menuItem);

            if (count($childrens)) {
                $ret[] = array_merge($menuItem->toArray(), [
                    'submenu' => $childrens
                ]);
            } else {
                $ret[] = $menuItem->toArray();
            }
        }

        return response()->json($ret);
    }

    private function get_childrens($menuItem){
        $ret = array();

        if ($menuItem->childrens && count($menuItem->childrens)) {
            foreach ($menuItem->childrens as $children) {
                $item = $children->parent;
                $subChildrens = $this->get_childrens($item);

                if (count($subChildrens)) {
                    $ret[] = array_merge($item->toArray(), [
                        'submenu' => $subChildrens
                    ]);
                } else {
                    $ret[] = $item->toArray();
                }
            }
        }

        return $ret;
    }
}
