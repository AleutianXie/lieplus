<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    //
    protected $table = 'mylibraries';

    public function getResume()
    {
        return $this->hasOne('App\Resume', 'rid');
    }
}
