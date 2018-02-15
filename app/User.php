<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */

	protected $fillable = [
		'name',
		'email',
		'password',
		'player_id',
        'coins',
        'rate'
	];

	protected $guarded = [
		'password',
	];

	public function stats()
    {
        return $this->belongsTo(Stat::class);
    }
}
