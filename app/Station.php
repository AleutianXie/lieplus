<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    //
    public function resume()
    {
        return $this->hasOne('App\Resume', 'id', 'rid');
    }
}
