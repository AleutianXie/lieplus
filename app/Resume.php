<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

//  add check later
    public function openContact()
    {
        return $this->creater == Auth::id() ? 'True' : 'Flase';
    }

    public function getmobileAttribute($value)
    {
        //dd($this->name);
        //return ucfirst("1234.56");
        return $this->creater == Auth::id() ? $value : "******";
    }

}
