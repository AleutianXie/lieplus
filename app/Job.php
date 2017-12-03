<?php

namespace App;

use App\AssignCustomer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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
        return $this->hasOne('App\Customer', 'id', 'cid')->with('project')->with('assigned');
    }

    public function department()
    {
        return $this->hasOne('App\Department', 'id', 'did');
    }

    public function line()
    {
        return $this->belongsTo('App\Line', 'id', 'jid')->with('assign');
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

    public function getisMineAttribute()
    {
        if (AssignCustomer::where(['uid' => Auth::id(), 'cid' => $this->customer->id])->first())
        {
            return true;
        }
        return false;
    }
}
