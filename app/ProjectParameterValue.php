<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectParameterValue extends Model
{
    protected $table = null;
    public $timestamps = false;
    public function __construct()
    {
        $this->setTable('projects_parameters_values');
    }

    /**
     * @param null $table
     */
    public function setTable($table): void
    {
        $this->table = $table;
    }

}