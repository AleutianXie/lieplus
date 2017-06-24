<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobLibrary extends Model
{
    //
    protected $table = 'joblibraries';

    public function resume()
    {
        return $this->hasOne('App\Resume', 'id', 'rid');
    }

    public function line()
    {
        return $this->hasOne('App\line', 'jid', 'jid');
    }
}
