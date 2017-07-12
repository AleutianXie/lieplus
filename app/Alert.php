<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Alert
 *
 * @mixin \Eloquent
 */
class Alert extends Model
{
    //
    protected $table = 'alerts';

    public function getResume()
    {
        return $this->hasOne('App\Resume', 'rid');
    }

}
