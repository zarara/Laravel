<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scheduled extends Model
{
    protected $table = 'scheduled';
    protected $fillable =
        [
            'reciver_id',
            'reciver_type',
            'message',
            'datetime',
            'status'
        ];
    protected $dates = ['datetime'];

    function template()
    {
        return $this->hasMany(Template::class);
    }

    function reciver()
    {
        return $this->morphTo();
    }

    public function getReciverNameAttribute()
    {
        if ($this->reciver instanceof Matakuliah) {
            return $this->reciver->name;

        } elseif ($this->reciver instanceof Pendaftar){
            return $this->reciver->name;
        } 
        return null;
    }

}
