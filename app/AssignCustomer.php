<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\AssignCustomer
 *
 * @property-read \App\Customer $customer
 * @mixin \Eloquent
 */
class AssignCustomer extends Model
{
    //
    protected $table = 'assigncustomers';

    public function customer()
    {
        return $this->hasOne('App\Customer', 'id', 'cid')->with('jobs');
    }

    public function adviser()
    {
        return $this->hasOne('App\User', 'id', 'uid');
    }
}
