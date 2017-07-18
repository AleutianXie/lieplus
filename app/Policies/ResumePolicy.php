<?php

namespace App\Policies;

use App\Resume;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ResumePolicy extends Policy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the resume.
     *
     * @param  \App\User  $user
     * @param  \App\Resume  $resume
     * @return mixed
     */
    public function view(User $user, Resume $resume)
    {
        return $user->hasPermission($this->get_class_name($resume), __FUNCTION__);
    }

    /**
     * Determine whether the user can create resumes.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermission('resume', __FUNCTION__);
    }

    /**
     * Determine whether the user can update the resume.
     *
     * @param  \App\User  $user
     * @param  \App\Resume  $resume
     * @return mixed
     */
    public function update(User $user, Resume $resume)
    {
        return $user->hasPermission($this->get_class_name($resume), __FUNCTION__);
    }

    /**
     * Determine whether the user can delete the resume.
     *
     * @param  \App\User  $user
     * @param  \App\Resume  $resume
     * @return mixed
     */
    public function delete(User $user, Resume $resume)
    {
        return $user->hasPermission($this->get_class_name($resume), __FUNCTION__);
    }
}
