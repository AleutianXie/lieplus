<?php
namespace Cici\Lieplus\Traits;

use Cici\Lieplus\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Expression;

trait JobTrait
{
    /**
     * A model may have multiple jobs.
     */
    public function jobs()
    {
        return $this->belongsToMany(
            'Cici\Lieplus\Models\Job',
            'user_has_jobs'
        );
    }

    /**
     * Assign the given jobs to the model.
     *
     * @param array ...$jobs
     *
     * @return $this
     */
    public function assignJobs(...$jobs)
    {
        $job_ids = $this->jobs()->pluck('job_id')->toArray();

        $jobs = collect($jobs)
            ->flatten()
            ->filter(function ($job) use ($job_ids) {
                return !in_array($job, $job_ids);
            })
            ->map(function ($job) {
                return Job::findOrFail($job);
            })
            ->all();

        $this->jobs()->saveMany($jobs);

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
