<?php
namespace Cici\Lieplus\Models;

use Cici\Lieplus\Exceptions\NameAlreadyExists;
use Cici\Lieplus\Traits\ResumeTrait;
use Cici\Lieplus\Traits\UserTrait;
use Illuminate\Support\Collection;

/**
 * Job model instance
 */
class Job extends Base
{
    use ResumeTrait;
    use UserTrait;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable('jobs');
    }

    public $guarded = ['id'];

    public static function create(array $attributes)
    {
        $department_id   = $attributes['department_id'];
        $name            = $attributes['name'];
        $requirement     = $attributes['requirement'];
        $work_years      = $attributes['work_years'];
        $gender          = $attributes['gender'];
        $majors          = $attributes['majors'];
        $degree          = $attributes['degree'];
        $unified         = $attributes['unified'];
        $salary          = $attributes['salary'];
        $property        = $attributes['property'];
        $closed          = $attributes['closed'];
        $created_by      = $attributes['created_by'];
        $updated_by      = $attributes['updated_by'];

        if (static::getJobs()->where('department_id', $department_id)->where('name', $name)->first()) {
            throw NameAlreadyExists::create($name);
        }

        return static::query()->create(compact(
            'department_id',
            'name',
            'requirement',
            'work_years',
            'gender',
            'majors',
            'degree',
            'unified',
            'salary',
            'property',
            'closed',
            'created_by',
            'updated_by'
        ));
    }

    /**
     * Get the department that owns the job.
     */
    public function department() : BelongsTo
    {
        return $this->belongsTo('Cici\Liplus\Models\Department');
    }

    /**
     * Get the current cached job.
     */
    protected static function getJobs(): Collection
    {
        return app(Job::class)->get();
    }
}
