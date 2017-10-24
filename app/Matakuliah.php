<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Matakuliah
 *
 * @property-read \App\Jurusan $jurusan
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Period[] $period
 * @mixin \Eloquent
 */
class Matakuliah extends Model {
	protected $table = 'matakuliah';

	protected $fillable = 
		[
			'kode', 
			'name', 
			'type', 
			'semester', 
			'active'
		];

	function jurusan() {
		return $this->belongsTo(Jurusan::class);
	}

	function pendaftar() {
		return $this->morphedByMany(Pendaftar::class, 'chooser', 'matakuliah_asisten')->withPivot('period_id', 'chooser_id', 'active')->withTimestamps();
	}

	function user() {
		return $this->morphedByMany(User::class, 'chooser', 'matakuliah_asisten')->withPivot('chooser_id', 'period_id', 'active')->withTimestamps();
	}

	function period() {
		return $this->belongsToMany(Period::class, 'matakuliah_asisten')->withPivot('chooser_id', 'matakuliah_id', 'active')->withTimestamps();
	}

	function scheduled(){
		return $this->morphMany(Scheduled::class,'reciver');
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
