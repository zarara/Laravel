<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Role
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @mixin \Eloquent
 */
class Role extends Model {
	protected $table = 'role';

	protected $fillable = [
		'kode',
		'hierarchy',
		'name',
		'description'
	];

	function users() {
		return $this->belongsToMany(User::class)->withPivot('active')->withTimestamps();
	}
}
