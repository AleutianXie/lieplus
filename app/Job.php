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
    public function customer()
    {
        return $this->hasOne('App\Customer', 'id', 'cid')->with('project');
    }

    public function department()
    {
        return $this->hasOne('App\Department', 'id', 'did');
    }

    public function line()
    {
        return $this->belongsTo('App\Line', 'id', 'jid');
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
