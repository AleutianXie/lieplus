<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignCustomer extends Model
{
    //
    protected $table = 'assigncustomers';

    public function customer()
    {
        return $this->hasOne('App\Customer', 'id', 'cid');
    }
}
