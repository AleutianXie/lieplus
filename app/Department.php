<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model {
	//
	public static function get() {

		if (empty(config('lieplus.departments'))) {
			$departments = [];

			foreach (static::where(['show' => 1])->get(['id', 'name', 'cid'])->toArray() as $key => $value) {
				$departments[$value['cid']][$value['id']] = $value['name'];
			}
			config(['lieplus.departments' => $departments]);
		}

	}
}
