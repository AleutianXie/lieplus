<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'uid');
    }

    public function department()
    {
        return $this->hasOne('App\UserDepartment', 'id', 'did');
    }
}
