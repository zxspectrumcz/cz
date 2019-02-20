<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectType extends Model
{
   protected $languages_id=1;

    public  function rootTypes(){
        return ProjectType::where('root','1')->where('languages_id',$this->languages_id)->get();
    }
    public  function childrens(){
        return $this->hasMany('App\ProjectTypesHasProjectType','project_type_id','id');
    }

    public  function getParameters(){
        return $this->belongsToMany('App\Parameter', 'project_types_parameters','project_type_id','parameter_languages_index');
    }
}
