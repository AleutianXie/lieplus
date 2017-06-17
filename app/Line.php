<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Line extends Model
{
    //
    public function stations()
    {
        return $this->hasMany('App\Station', 'lid');
    }
}
