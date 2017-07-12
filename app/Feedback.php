<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Feedback
 *
 * @mixin \Eloquent
 */
class Feedback extends Model
{
    //
    protected $table = 'feedbacks';

    public static $strictModeration = false;
}
