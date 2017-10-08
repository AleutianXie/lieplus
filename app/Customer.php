<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Customer
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Job[] $job
 * @mixin \Eloquent
 */
class Customer extends Model
{
    //
    protected $table = 'customers';

    public function jobs()
    {
        return $this->hasMany('App\Job', 'cid');
    }
}
