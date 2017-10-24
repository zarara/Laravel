<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Jurusan
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Matakuliah[] $matakuliah
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $asisten
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Pendaftar[] $pendaftar
 * @mixin \Eloquent
 */
class Jurusan extends Model {
	protected $table = 'jurusan';

	protected $fillable =
		[
			'kode',
			'name',
			'alias',
			'active'
		];

	function matakuliah() {
		return $this->hasMany(Matakuliah::class);
	}

	function user() {
		return $this->hasMany(User::class);
	}

	function pendaftar() {
		return $this->hasMany(Pendaftar::class);
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
