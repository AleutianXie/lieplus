<?php

namespace App\Policies;

use App\User;

class Policy
{
    public function before(User $user)
    {
        return $user->isAdmin ? true : null;
    }
}
