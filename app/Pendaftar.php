<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;


class Pendaftar extends Model
{
    use Notifiable;
    # Tentukan nama tabel terkait
    protected $table = 'pendaftar';
  
    protected $fillable = [
        'npm',
        'jurusan_id',
        'name',
        'email',
        'gender',
        'kontak',
        'address',
        'date_of_birth',
        'place_of_birth',
        'tft',
        'rekening',
        'sks',
        'ipk',
        'org_exp',
    ];

    protected $dates = ['deleted_at'];

    function jurusan() {
        return $this->belongsTo(Jurusan::class);
    }
    
    function matakuliah() {
        return $this->morphToMany(Matakuliah::class, 'chooser', 'matakuliah_asisten')->withPivot('period_id', 'matakuliah_id', 'active')->withTimestamps();
    }

    function period() {
        return $this->morphToMany(Period::class, 'chooser', 'matakuliah_asisten')->withPivot('matakuliah_id', 'period_id', 'active')->withTimestamps();
    }

    function inbox(){
        return $this->belongsTo(Inbox::class);
    }
    function outbox(){
        return $this->hasMany(Outbox::class, 'reciver_id');
    }
    public function routeNotificationForZenziva()
    {
        return $this->kontak; // Depends on your users table field.
    }
    function scheduled(){
        return $this->morphMany(Scheduled::class,'reciver');
    }
}
