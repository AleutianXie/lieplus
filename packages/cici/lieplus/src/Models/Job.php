<?php
namespace Cici\Lieplus\Models;

use Cici\Lieplus\Exceptions\NameAlreadyExists;
use Cici\Lieplus\Traits\ResumeTrait;
use Cici\Lieplus\Traits\UserTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

/**
 * Job model instance
 */
class Job extends Base
{
    use ResumeTrait;
    use UserTrait;

    protected $appends = ['serial_number', 'is_mine', 'resume_count'];

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
        $created_by      = Auth::id();
        $updated_by      = Auth::id();

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
        return $this->belongsTo('Cici\Lieplus\Models\Department');
    }

    /**
     * A job may be belongs to a line.
     */
    public function line() : HasOne
    {
        return $this->hasOne('Cici\Lieplus\Models\Line');
    }

    /**
     * Get the current cached job.
     */
    protected static function getJobs(): Collection
    {
        return app(Job::class)->get();
    }

    public function getIsMineAttribute()
    {
        $user_ids = $this->users()->pluck('user_id')->toArray();

        return in_array(Auth::id(), $user_ids);
    }

    public function getAdviserAttribute()
    {
        $user_ids = $this->users()->pluck('user_id')->map(function ($item) {
            return Auth::user($item)->name;
        });

        return $user_ids->all();
    }

    public function getResumeCountAttribute()
    {
        return $this->resumes()->count();
    }
}
