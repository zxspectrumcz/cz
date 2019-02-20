<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectTypesHasProjectType extends Model
{
     // link to the project type
    public function parent() {
        return $this->belongsTo('App\ProjectType','project_type_child_id','id');
    }
}

