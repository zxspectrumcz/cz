<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SettingsValue extends Model
{

    public $timestamps = false;
    
    protected $fillable = ['id', 'textvalue', 'intvalue', 'filevalue', 'settings_name_id'];
}
