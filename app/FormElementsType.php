<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormElementsType extends Model
{
    public function rule()
    {
       return $this->hasOne('App\Rule', 'id','rule_id');
    }

}