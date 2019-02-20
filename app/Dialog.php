<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dialog extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'project_id',
        'title'
    ];

    public $timestamps = false;

    public function messages() {
        return $this->hasMany('App\Message', 'dialog_id', 'id');
    }

    public function users() {
        return $this->belongsToMany('App\User');
    }
}
