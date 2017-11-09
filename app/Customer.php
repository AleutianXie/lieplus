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
        return $this->hasMany('App\Job', 'cid')->with('customer');
    }

    public function project()
    {
        return $this->hasOne('App\Project', 'cid');
    }

    public function pause()
    {
        $this->closed = 1;
        return $this->save();
    }

    public function open()
    {
        $this->closed = 0;
        return $this->save();
    }
}
