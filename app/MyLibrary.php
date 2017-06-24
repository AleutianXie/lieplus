<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MyLibrary extends Model
{
    //
    protected $table = 'mylibraries';

    public function resume()
    {
        return $this->hasOne('App\Resume', 'id', 'rid');
    }
}
