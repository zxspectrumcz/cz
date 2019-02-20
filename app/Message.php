<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'id',
        'dialog_id',
        'user_id',
        'text',
        'createdOn'
    ];

    public $timestamps = false;

    public function author() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function dialog() {
        return $this->belongsTo('App\Dialog', 'dialog_id', 'id');
    }

    public function files() {
        return $this->hasMany('App\MessageFile', 'message_id', 'id');
    }
}
