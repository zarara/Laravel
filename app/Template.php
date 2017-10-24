<?php

namespace App;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $table = 'template';

    protected $fillable =
        [
            'title',
            'message'
        ];
    function scheduled() {
        return $this->hasOne(Schedule::class);
    }
}
