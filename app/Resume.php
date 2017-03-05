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
}
