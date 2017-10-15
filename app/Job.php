<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Job
 *
 * @property-read \App\Customer $customer
 * @mixin \Eloquent
 */
class Job extends Model
{
    //
    //
    public function customer()
    {
        return $this->hasOne('App\Customer', 'id', 'cid');
    }

    public function department()
    {
        return $this->hasOne('App\Department', 'id', 'did');
    }
}
