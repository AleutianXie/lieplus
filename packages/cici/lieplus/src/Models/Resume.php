<?php
namespace Cici\Lieplus\Models;

use Cici\Lieplus\Exceptions\EmailAlreadyExists;
use Cici\Lieplus\Exceptions\MobileAlreadyExists;
use Cici\Lieplus\Models\Region;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * Resume model instance
 */
class Resume extends Base
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable('resumes');
    }

    public $guarded = ['id'];

    public static function create(array $attributes)
    {
        $name            = $attributes['name'];
        $mobile          = $attributes['mobile'];
        $email           = $attributes['email'];
        $gender          = $attributes['gender'];
        $birthdate       = $attributes['birthdate'];
        $start_work_date = $attributes['start_work_date'];
        $degree          = $attributes['degree'];
        $service_status  = $attributes['service_status'];
        $province        = $attributes['province'];
        $city            = $attributes['city'];
        $county          = $attributes['county'];
        $position        = $attributes['position'];
        $industry        = $attributes['industry'];
        $salary          = $attributes['salary'];
        $others          = $attributes['others'];
        $created_by      = $attributes['created_by'];
        $updated_by      = $attributes['updated_by'];

        if (static::getResumes()->where('mobile', $mobile)->first()) {
            throw MobileAlreadyExists::create($mobile);
        }
        if (static::getResumes()->where('email', $email)->first()) {
            throw EmailAlreadyExists::create($email);
        }
        return static::query()->create(compact(
            'name',
            'mobile',
            'email',
            'gender',
            'birthdate',
            'start_work_date',
            'degree',
            'service_status',
            'province',
            'city',
            'county',
            'position',
            'industry',
            'salary',
            'others',
            'created_by',
            'updated_by'
        ));
    }

    /**
     * A resume can be applied to roles.
     */
    public function feedbacks(): HasMany
    {
        return $this->hasMany(
            'Cici\Lieplus\Models\Feedback'
        );
    }

    public function postFeedback($attributes = [])
    {
        return $this->feedbacks()->create($attributes);
    }

    /**
     * A role may be given various jobs.
     */
    public function jobs() : BelongsToMany
    {
        return $this->belongsToMany(
            'Cici\Lieplus\Models\Job',
            'job_has_resumes'
        );
    }

    /**
     * Assign the given job to the resume.
     *
     * @param array ...$jobs
     *
     * @return $this
     */
    public function assignJob($attributes = [], ...$jobs)
    {
        $job_ids = $this->jobs()->pluck('job_id')->toArray();

        $jobs = collect($jobs)
            ->flatten()
            ->filter(function($id) use ($job_ids) {
                return !in_array($id, $job_ids);
            })
            ->map(function ($id) {
                return Job::findorFail($id);
            })
            ->all();

        return $this->jobs()->withTimestamps()->withPivotValue($attributes)->saveMany($jobs);
    }

    public function getprovinceAttribute($value)
    {
        $region = Region::getInstance();
        return $region->getNameByAdcode($value);
    }

    public function getcityAttribute($value)
    {
        $region = Region::getInstance();
        return $region->getNameByAdcode($value);
    }

    public function getcountyAttribute($value)
    {
        $region = Region::getInstance();
        return $region->getNameByAdcode($value);
    }

    /**
     * Get the current cached resume.
     */
    protected static function getResumes(): Collection
    {
        return app(Resume::class)->get();
    }
}
