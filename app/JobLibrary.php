<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobLibrary extends Model
{
    //
    protected $table = 'joblibraries';

    public function getResume()
    {
        return $this->hasOne('App\Resume', 'id', 'rid');
    }
}
