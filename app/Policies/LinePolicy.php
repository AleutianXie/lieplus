<?php

namespace App\Policies;

use App\Line;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LinePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the line.
     *
     * @param  \App\User  $user
     * @param  \App\Line  $line
     * @return mixed
     */
    public function view(User $user, Line $line)
    {
        return $user->hasPermission($this->get_class_name($line), __FUNCTION__);
    }

    /**
     * Determine whether the user can create lines.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermission('line', __FUNCTION__);
    }

    /**
     * Determine whether the user can update the line.
     *
     * @param  \App\User  $user
     * @param  \App\Line  $line
     * @return mixed
     */
    public function update(User $user, Line $line)
    {
        return $user->hasPermission($this->get_class_name($line), __FUNCTION__);
    }

    /**
     * Determine whether the user can delete the line.
     *
     * @param  \App\User  $user
     * @param  \App\Line  $line
     * @return mixed
     */
    public function delete(User $user, Line $line)
    {
        return $user->hasPermission($this->get_class_name($line), __FUNCTION__);
    }
}
