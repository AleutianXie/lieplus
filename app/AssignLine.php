<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignLine extends Model
{
    //
    protected $table = 'assignlines';

    public function line()
    {
        return $this->hasOne('App\Line', 'id', 'lid');
    }
}
