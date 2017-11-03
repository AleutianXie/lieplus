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

    public function getmobileAttribute($value)
    {
        return Auth::user()->hasRole('admin') || $this->creater == Auth::id() || $this->passNDays() ? $value : substr_replace($value, "****", 3, 4);
    }

    public function getemailAttribute($value)
    {
        $index = strpos($value, '@');
        $start = $index - 4 >= 1 ? $index - 4 : 1;
        $length = $index - 4 >= 1 ? 4 : $index - 1;
        $replace = $index - 4 >= 1 ? '****' : substr('****', $length);
        return Auth::user()->hasRole('admin') || $this->creater == Auth::id() || $this->passNDays() ? $value : substr_replace($value, $replace, $start, $length);
    }

    private function passNDays(int $n = 1)
    {
        return time() - strtotime($this->created_at) > 60 * 60 * 24 * $n;
    }

}
