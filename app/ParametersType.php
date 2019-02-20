<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParametersType extends Model
{
    public  function getParameters(){
        return $this->belongsToMany('App\Parameter', 'parameters_types_parameters');
    }
}
