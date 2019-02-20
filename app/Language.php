<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table = 'languages';

    public  function get_users() {
        return $this->hasMany('App\User');
    }
    
    // get one value of some setting  AG1  - stringname of setting
    public  function get_one_value($setnamesting) {
        return $this->hasMany('App\SettingsName')->where('name','LIKE',$setnamesting)->first()->get_one_value();
    }

    // get all values of some setting 
    public function get_all_values($setnamesting){
        return $this->hasMany('App\SettingsName')->where('name','LIKE',$setnamesting)->first()->get_all_values();
    }



    // STATIC
        // get one value ob this setting
    public static function getOneValue($language,$setting) {
        return Language::where('name', 'LIKE',$language)->first()->get_one_value($setting)->get();  
    }

    // STATIC
    public static function getAllValues($language,$setting){
        return Language::where('name', 'LIKE',$language)->first()->get_all_values($setting)->get();
    }



}
