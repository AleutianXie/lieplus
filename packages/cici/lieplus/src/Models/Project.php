<?php
namespace Cici\Lieplus\Models;

use Cici\Lieplus\Exceptions\ProjectAlreadyExists;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

/**
 * Project model instance
 */
class Project extends Base
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable('projects');
    }

    public $guarded = ['id'];

    public static function create(array $attributes)
    {
        $job_id          = $attributes['job_id'];
        $status          = $attributes['status'];
        $created_by      = Auth::id();
        $updated_by      = Auth::id();

        if (static::getProjects()->where('job_id', $job_id)->first()) {
            throw ProjectAlreadyExists::create($job_id);
        }

        return static::query()->create(compact(
            'job_id',
            'status',
            'created_by',
            'updated_by'
        ));
    }

    /**
     * Get the job that owns the project.
     */
    public function job() : hasOne
    {
        return $this->hasOne('Cici\Liplus\Models\Job');
    }

    /**
     * Get the current cached project.
     */
    protected static function getProjects(): Collection
    {
        return app(Project::class)->get();
    }
}
