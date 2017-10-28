<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    //
    public function line()
    {
        return $this->hasOne('App\Line', 'id', 'lid');
    }
}
