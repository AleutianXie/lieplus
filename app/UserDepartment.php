<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDepartment extends Model
{
    //
    protected $table = 'userdepartments';

    public function getProfiles()
    {
        return $this->hasMany('App\Profile', 'did');
    }
}
