<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\JobLibrary
 *
 * @property-read \App\Line $line
 * @property-read \App\Resume $resume
 * @mixin \Eloquent
 */
class JobLibrary extends Model
{
	//
	protected $table = 'joblibraries';

	public function resume()
	{
		return $this->hasOne('App\Resume', 'id', 'rid');
	}

	public function line()
	{
		return $this->hasOne('App\Line', 'jid', 'jid');
	}
}
