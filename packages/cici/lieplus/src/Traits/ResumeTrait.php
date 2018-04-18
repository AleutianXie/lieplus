<?php
namespace Cici\Lieplus\Traits;

use Cici\Lieplus\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Expression;

trait ResumeTrait
{
    /**
     * A model may have multiple roles.
     */
    public function resumes()
    {
        return $this->belongsToMany(
            'Cici\Lieplus\Models\Resume',
            'user_has_resumes'
        );
    }

    /**
     * Assign the given role to the model.
     *
     * @param array ...$roles
     *
     * @return $this
     */
    // public function assignRole(...$roles)
    // {
    //     $roles = collect($roles)
    //         ->flatten()
    //         ->map(function ($role) {
    //             return $this->getStoredRole($role);
    //         })
    //         ->all();

    //     $this->roles()->saveMany($roles);

    //     return $this;
    // }

    /**
     * Revoke the given role from the model.
     *
     * @param string|\Spatie\Permission\Contracts\Role $role
     */
    // public function removeRole($role)
    // {
    //     $this->roles()->detach($this->getStoredRole($role));
    // }

    // protected function getStoredRole($role): Role
    // {
    //     if (is_numeric($role)) {
    //         return app(Role::class)->findById($role);
    //     }

    //     if (is_string($role)) {
    //         return app(Role::class)->findByName($role);
    //     }

    //     return $role;
    // }
}
