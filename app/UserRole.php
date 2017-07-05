<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    //
    public function permission()
    {
        return $this->hasMany('App\RolePermission', 'rid', 'rid');
    }
}
