<?php
namespace Cici\Lieplus\Traits;

use Cici\Lieplus\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Expression;

trait ResumeTrait
{
    /**
     * A model may have multiple resumes.
     */
    public function resumes()
    {
        return $this->belongsToMany(
            'Cici\Lieplus\Models\Resume',
            snake_case(class_basename(static::class)).'_has_resumes'
        );
    }

    /**
     * Assign the given resumes to the model.
     *
     * @param array ...$resumes
     *
     * @return $this
     */
    public function assignResumes(...$resumes)
    {
        $resume_ids = $this->resumes()->pluck('resume_id')->toArray();

        $resumes = collect($resumes)
            ->flatten()
            ->filter(function ($resume) use ($resume_ids) {
                return !in_array($resume, $resume_ids);
            })
            ->map(function ($resume) {
                return Resume::findOrFail($resume);
            })
            ->all();

        $this->resumes()->saveMany($resumes);

        return $this;
    }

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
