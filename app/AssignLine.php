<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\AssignLine
 *
 * @property-read \App\Line $line
 * @mixin \Eloquent
 */
class AssignLine extends Model
{
    //
    protected $table = 'assignlines';

    public function line()
    {
        return $this->hasOne('App\Line', 'id', 'lid')->with('assign');
    }

    public function adviser()
    {
        return $this->hasOne('App\User', 'id', 'uid');
    }
}
