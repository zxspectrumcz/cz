<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    public function values()
    {
        return $this->hasMany('App\ParametersValue' , 'parameter_id' , 'id');
    }
    public function element()
    {
        return FormElementsType::find($this->elem_type_id);
    }
    public function rule()
    {
        return $this->hasOne('App\Rule', 'id','rule_id');
    }
}