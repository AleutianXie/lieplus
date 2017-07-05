<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $table = 'customers';

    public function job()
    {
        return $this->hasMany('App\Job', 'cid');
    }
}
