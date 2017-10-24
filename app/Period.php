<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    protected $table = 'period';

    protected $fillable = [
        'year',
        'semester',
        'description',
        'active'
    ];

    function event() {
        return $this->belongsToMany(Event::class)->withPivot('slug', 'start_date', 'end_date', 'active');
    }

    function event_period() {
        return $this->hasMany(EventPeriod::class);
    }

    function info() {
        return $this->hasManyThrough(Info::class, EventPeriod::class);
    }

    function pendaftar() {
        return $this->morphedByMany(Pendaftar::class, 'chooser', 'matakuliah_asisten')->withPivot('matakuliah_id', 'nilai', 'active')->withTimestamps();
    }

    function user() {
        return $this->morphedByMany(User::class, 'chooser', 'matakuliah_asisten')->withPivot('matakuliah_id', 'nilai', 'active')->withTimestamps();
    }

    function matakuliah() {
        return $this->belongsToMany(Matakuliah::class, 'matakuliah_asisten')->withPivot('chooser_id', 'matakuliah_id', 'active')->withTimestamps();
    }

    function activate() {
        $this->active = 1;
        return $this->save();
    }

    function deactivate() {
        $this->active = 0;
        return $this->save();
    }
}
