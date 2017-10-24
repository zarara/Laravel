<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inbox extends Model
{
    protected $table = 'inbox';
    protected $fillable =
        [
            'reciver_id',
            'message',
            'date_recive',
            'time_recive',
            'status'
        ];
    function template() {
        return $this->hasMany(Template::class);
    }
    function pendaftar(){
        return $this->hasOne(Pendaftar::class);
    }
    
}
