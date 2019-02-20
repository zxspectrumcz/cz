<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Language;

class SettingsName extends Model
{

    public $timestamps = false;
    
    protected $fillable = ['id', 'language_id', 'name', 'use_values'];


    // get one value ob this setting
    public function get_one_value() {
        return $this->hasMany('App\SettingsValue')->first();
    }

    // get all values of this setting 
    public function get_all_values(){
        return $this->hasMany('App\SettingsValue');
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
