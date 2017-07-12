<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function profile()
    {
        return $this->hasOne('App\Profile', 'uid', 'id');
    }

    public function role()
    {
        return $this->hasMany('App\UserRole', 'uid', 'id');
    }

    public function getisAdminAttribute()
    {
        return !empty($this->hasMany('App\UserRole', 'uid', 'id')->where(['rid' => 1])->get()->toArray());
    }

    public function hasPermission($model = 'resume', $action = 'view')
    {
        return !empty(array_where(array_collapse(array_pluck($this->role, 'permission')), function ($value) use ($model, $action)
        {
            return $value->model == strtolower($model) && $value->action == strtolower($action) && $value->enabled == 1;
        }));
    }
}
