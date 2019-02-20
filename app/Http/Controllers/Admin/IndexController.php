<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AdminMenu;
use App\Languag;

class IndexController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     
    public function index() 
    {   
        return view('admin.index');
    }
         
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    // public function indextry() {

    //     $menus = AdminMenu::where('root',1)->orderBy('order')->get();

    //     foreach($menus as $menu){
    //         print '<ul>';
    //             print $menu->name.'<br>';
    //             print $this->print_childrens($menu);
    //             print '<br>';
    //         print '</ul>';
    //     }
    // }

    // private function print_childrens($menu){

    //     $childrens = $menu->getChildrens();
    //     foreach ($childrens as $children) {
    //         print '<ul>';
    //             print '->' .$children->name.'<br>';
    //             $childsofchildren = $children->getChildrens();
                
    //             if(count($childsofchildren) > 0) {
    //                 $this->print_childrens($children);
    //             }
    //         print '</ul>';
    //     }
    // }















    // public function indextry() {
        
    //     $menus = AdminMenu::where('root',1)->orderBy('order')->get();
    //     $menu_value = array();

    //     $front = '<ul>';
    //         foreach($menus as $menu){
    //             $tree = $menu->name.'<br>';
    //             $tree .= $this->print_childrens($menu, '');
    //             $tree .= '<br>';
    //             array_push($menu_value,$tree);
    //         }
            
    //         foreach($menu_value as $menu_val){
    //             $front .= $menu_val;
    //         }
    //     $front .= '</ul>';


    //     return view('admin/index')->with([
    //         'front' => $front
    //     ]);
    // }

    // private function print_childrens($menu, $tree){
        
    //     $childrens = $menu->getChildrens();
    //     foreach ($childrens as $children) {
    //         $tree .= '<ul>';
    //             $tree .= '->' .$children->name.'<br>';
    //             $childsofchildren = $children->getChildrens();
                
    //             if(count($childsofchildren) > 0) {
    //                 $tree .= $this->print_childrens($children, '');
    //             }
    //         $tree .= '</ul>';
    //     }

    //     return $tree;
    // }

}
