<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    //
    protected $table = 'libraries';

    public function getResume()
    {
        return $this->hasOne('App\Resume', 'rid');
    }
}
