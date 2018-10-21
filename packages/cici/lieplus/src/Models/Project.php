<?php

namespace Cici\Lieplus\Models;

use Cici\Lieplus\Exceptions\ProjectAlreadyExists;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

/**
 * Project model instance
 */
class Project extends Base
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $appends = ['serial_number', 'job_name', 'company_name', 'company_level', 'company_type'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable('projects');
    }

    public $guarded = ['id'];

    public static function create(array $attributes)
    {
        $job_id = $attributes['job_id'];
        $status = $attributes['status'];
        $created_by = Auth::id();
        $updated_by = Auth::id();

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
    public function job(): BelongsTo
    {
        return $this->belongsTo('Cici\Lieplus\Models\Job');
    }

    /**
     * Get the current cached project.
     */
    protected static function getProjects(): Collection
    {
        return app(Project::class)->get();
    }

    public function getJobNameAttribute()
    {
        return $this->job->name;
    }

    public function getCompanyNameAttribute()
    {
        return $this->job->department->customer->name;
    }

    public function getCompanyLevelAttribute()
    {
        return $this->job->department->customer->level;
    }

    public function getCompanyTypeAttribute()
    {
        return $this->job->department->customer->type;
    }

    public function scopeCompanyName($query, $name)
    {
        return $query->whereHas('job', function ($query) use ($name) {
            return $query->whereHas('department', function ($query) use ($name) {
                return $query->whereHas('customer', function ($query) use ($name) {
                    return $query->where('name', 'like', '%' . $name . '%');
                });
            });
        });
    }

    public function scopeJobName($query, $name)
    {
        return $query->whereHas('job', function ($query) use ($name) {
            return $query->where('name', 'like', '%' . $name . '%');
        });
    }
}
