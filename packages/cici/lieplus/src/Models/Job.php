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

    protected $appends = ['serial_number', 'is_mine', 'resume_count', 'options_link'];

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

    public function scopeProjectStatus($query, $status)
    {
        return $query->whereHas('department', function ($query) use ($status) {
            return $query->whereHas('customer', function ($query) use ($status) {
                return $query->where('status', $status);
            });
        });
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

    public function getOptionsLinkAttribute()
    {
        $options = '<div class="dropdown"><a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="true"><i class="purple ace-icon fa fa-asterisk bigger-120"></i>操作<i class="ace-icon fa fa-caret-down"></i></a><ul class="dropdown-menu dropdown-lighter dropdown-125 pull-right"><li><a href="' . route('customer.detail', $this->id) . '"><i class="blue ace-icon fa fa-eye bigger-120"></i>查看 </a></li>';
        if (Auth::user()->hasRole('admin') || Auth::id() == $this->created_by) {
            $options .= '<li><a href="' . route('customer.edit', $this->id) . '"><i class="blue ace-icon fa fa-edit bigger-120"></i>编辑 </a></li>';
        }

        if ($this->is_mine) {

            $options .= '<li><a href="' . route('resume.detail', [$this->id, 'notice']) . '"><i class="blue ace-icon fa fa-hand-scissors-o bigger-120"></i>更换客户顾问 </a></li>';
        }
        $options .= '<li><a href="javascript:void(0);" id="job-library-' . $this->id . '" data-rid="' . $this->id . '" data-name="' . $this->name . '" data-sn="' . $this->serial_number . '"><i class="blue ace-icon fa fa-plus-square bigger-120"></i>加入职位流水线 </a></li></ul></div>';
        return $options;
    }
}
