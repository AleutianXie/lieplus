<?php

namespace Cici\Lieplus\Models;

use App\User;
use Cici\Lieplus\Exceptions\EmailAlreadyExists;
use Cici\Lieplus\Exceptions\MobileAlreadyExists;
use Cici\Lieplus\Models\Region;
use Cici\Lieplus\Traits\UserTrait;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

/**
 * Resume model instance
 */
class Resume extends Base
{
    use UserTrait;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $appends = ['serial_number', 'feedback', 'is_mine', 'line_links', 'options_link'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable('resumes');
    }

    public $guarded = ['id'];

    public static function create(array $attributes)
    {
        $name = $attributes['name'];
        $mobile = $attributes['mobile'];
        $email = $attributes['email'];
        $gender = $attributes['gender'];
        $birthdate = $attributes['birthdate'];
        $start_work_date = $attributes['start_work_date'];
        $degree = $attributes['degree'];
        $service_status = $attributes['service_status'];
        $province = $attributes['province'];
        $city = $attributes['city'];
        $county = $attributes['county'];
        $position = $attributes['position'];
        $industry = $attributes['industry'];
        $salary = $attributes['salary'];
        $others = $attributes['others'];
        $created_by = $attributes['created_by'];
        $updated_by = $attributes['updated_by'];

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
     * A resume can have many feedbacks.
     */
    public function feedbacks(): HasMany
    {
        return $this->hasMany(
            'Cici\Lieplus\Models\Feedback'
        );
    }

    /**
     * Post a feed back for resume.
     */
    public function postFeedback(array $attributes)
    {
        return $this->feedbacks()->create($attributes);
    }

    /**
     * Post feed backs for resume.
     */
    public function postFeedbacks(...$feedbacks)
    {
        $feedbacks = collect($feedbacks)
            ->flatten(1)
            ->all();
        return $this->feedbacks()->createMany($feedbacks);
    }

    /**
     * A role may be given various jobs.
     */
    public function jobs(): BelongsToMany
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
            ->filter(function ($id) use ($job_ids) {
                return !in_array($id, $job_ids);
            })
            ->map(function ($id) {
                return Job::findorFail($id);
            })
            ->all();

        return $this->jobs()->withTimestamps()->withPivotValue($attributes)->saveMany($jobs);
    }

    public function getProvinceAttribute($value)
    {
        $region = Region::getInstance();
        return $region->getNameByAdcode($value);
    }

    public function getCityAttribute($value)
    {
        $region = Region::getInstance();
        return $region->getNameByAdcode($value);
    }

    public function getCountyAttribute($value)
    {
        $region = Region::getInstance();
        return $region->getNameByAdcode($value);
    }

    public function getFeedbackAttribute()
    {
        if ($this->feedbacks()->latest()->first()) {
            return $this->feedbacks()->latest()->first()->text;
        }
        return '';
    }

    public function scopeMobile($query, $mobile)
    {
        return $query->where('mobile', 'like', '%' . $mobile . '%');
    }

    /**
     * Get the current cached resume.
     */
    protected static function getResumes(): Collection
    {
        return app(Resume::class)->get();
    }

    public function getIsMineAttribute()
    {
        $user_ids = $this->users()->pluck('user_id')->toArray();

        return in_array(Auth::id(), $user_ids);
    }

    public function getLineLinksAttribute()
    {
        $line_names = [];
        if ($this->jobs->isNotEmpty()) {
            foreach ($this->jobs as $job) {
                if (!is_null($job->line)) {
                    $line_names[] = "<a href=\"" . route('line.detail', $job->line->id) . "\">" . $job->name . "(" . $job->line->serial_number . ")</a>";
                }
            }
        }
        return implode("<br/>", $line_names);
    }

    public function getOptionsLinkAttribute()
    {
        $options = '<div class="dropdown"><a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="true"><i class="purple ace-icon fa fa-asterisk bigger-120"></i>操作<i class="ace-icon fa fa-caret-down"></i></a><ul class="dropdown-menu dropdown-lighter dropdown-125 pull-right"><li><a href="' . route('resume.detail', $this->id) . '"><i class="blue ace-icon fa fa-eye bigger-120"></i>查看 </a></li>';
        if ($this->is_mine) {
            $options .= '<li><a href="' . route('resume.detail', [$this->id, 'notice']) . '"><i class="blue ace-icon fa fa-bell-o bigger-120"></i>提醒 </a></li>';
        } else {
            $options .= '<li><a href="#" id="my-' . $this->id . '" data-rid="' . $this->id . '"><i class="blue ace-icon fa fa-download bigger-120"></i>加入我的简历库 </a></li>';
        }
        $options .= '<li><a href="' . route('resume.jobmodal', $this->id) . '" data-toggle="modal" data-target="#modal-job" data-rid="' . $this->id . '"><i class="blue ace-icon fa fa-plus-square bigger-120"></i>加入职位流水线 </a></li></ul></div>';
        return $options;
    }
}
