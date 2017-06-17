<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MyLibrary extends Model
{
    //
    protected $table = 'mylibraries';

    public function getResume()
    {
        return $this->hasOne('App\Resume', 'id', 'rid');
    }
}
