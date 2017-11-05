<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Line extends Model
{
	//
	public function stations()
	{
		return $this->hasMany('App\Station', 'lid');
	}

	public function connection()
	{
		return $this->hasMany('App\Station', 'lid')->where(['status' => 1, 'show' => 1, 'disable' => 0]);
	}

	public function intention()
	{
		return $this->hasMany('App\Station', 'lid')->where(['status' => 2, 'show' => 1, 'disable' => 0]);
	}

	public function audit()
	{
		return $this->hasMany('App\Station', 'lid')->where(['status' => 7, 'show' => 1, 'disable' => 0]);
	}

	public function recommendation()
	{
		return $this->hasMany('App\Station', 'lid')->where(['status' => 3, 'show' => 1, 'disable' => 0]);
	}

	public function interview()
	{
		return $this->hasMany('App\Station', 'lid')->where(['status' => 4, 'show' => 1, 'disable' => 0]);
	}

	public function offer()
	{
		return $this->hasMany('App\Station', 'lid')->where(['status' => 5, 'show' => 1, 'disable' => 0]);
	}

	public function onboard()
	{
		return $this->hasMany('App\Station', 'lid')->where(['status' => 6, 'show' => 1, 'disable' => 0]);
	}

	public function GetStationsByStatus($status)
	{
		return $this->hasMany('App\Station', 'lid')->where(['status' => $status]);
	}

	public function job()
	{
		return $this->hasOne('App\Job', 'id', 'jid');
	}

	public function joblibrary()
	{
		return $this->hasMany('App\JobLibrary', 'jid', 'jid');
	}

	public function closed()
	{
		return $this->hasMany('App\Station', 'lid')->where(['show' => 1, 'disable' => 1]);
	}
}
