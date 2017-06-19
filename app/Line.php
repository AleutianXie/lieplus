<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Line extends Model
{
    //
    public function stations()
    {
        return $this->hasMany('App\Station', 'lid');
    }

    public function connection()
    {
        return $this->hasMany('App\Station', 'lid')->where(['status' => 1]);
    }

    public function intention()
    {
        return $this->hasMany('App\Station', 'lid')->where(['status' => 2]);
    }

    public function recommendation()
    {
        return $this->hasMany('App\Station', 'lid')->where(['status' => 3]);
    }

    public function interview()
    {
        return $this->hasMany('App\Station', 'lid')->where(['status' => 4]);
    }

    public function offer()
    {
        return $this->hasMany('App\Station', 'lid')->where(['status' => 5]);
    }

    public function onboard()
    {
        return $this->hasMany('App\Station', 'lid')->where(['status' => 6]);
    }

    public function GetStationsByStatus($status)
    {
        return $this->hasMany('App\Station', 'lid')->where(['status' => $status]);
    }

    public function customer()
    {
        return $this->hasOne('App\Customer', 'id', 'cid');
    }

    public function job()
    {
        return $this->hasOne('App\Job', 'id', 'jid');
    }
}
