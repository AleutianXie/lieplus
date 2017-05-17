<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model {
	//
	//
	public function customer() {
		return $this->belongsTo('App\Customer', 'cid');
	}
}
