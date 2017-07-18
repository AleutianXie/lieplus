<?php

namespace App\Policies;

use App\User;

class Policy
{
    public function before(User $user)
    {
        return $user->isAdmin ? true : null;
    }

    protected function get_class_name($class)
    {
        return array_last(explode('\\', get_class($class)));
    }
}
