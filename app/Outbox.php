<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outbox extends Model
{
    protected $table = 'outbox';
    protected $dates=['send_at'];
    protected $fillable =
        [
            'sender_id',
            'message',
            'send_at'
        ];
    function template() {
        return $this->hasMany(Template::class);
    }
    function pendaftar(){
        return $this->belongsTo(Pendaftar::class,'reciver_id');
    }
}
