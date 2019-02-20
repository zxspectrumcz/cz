<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageFile extends Model
{
    protected $fillable = [
        'id',
        'message_id',
        'filename',
        'download_url',
        'size',
        'type',
        'mimetype'
    ];

    protected $table = 'messages_files';
    public $timestamps = false;
}
