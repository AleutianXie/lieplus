<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    public function job()
    {
        return $this->hasOne('App\Job', 'id', 'jid');
    }

    public function company()
    {
        return $this->hasOne('App\Customer', 'id', 'cid');
    }
}
