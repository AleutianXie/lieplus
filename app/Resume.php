<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    //
    public function getFeedbacks()
    {
        return $this->hasMany('App\Feedback', 'rid');
    }

    public function publisher()
    {
        return $this->hasOne('App\User', 'id', 'creater');
    }

    public function alerts()
    {
        return $this->hasMany('App\Alert', 'rid');
    }
}
