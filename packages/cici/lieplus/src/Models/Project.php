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

    protected $appends = ['serial_number', 'job_name', 'company_name', 'company_level', 'company_type', 'options_link'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable('projects');
    }

    public $guarded = ['id'];

    public static function create(array $attributes)
    {
        $customer_id = $attributes['customer_id'];
        $job_id = $attributes['job_id'];
        $status = $attributes['status'];
        $created_by = Auth::id();
        $updated_by = Auth::id();

        if (static::getProjects()->where('job_id', $job_id)->first()) {
            throw ProjectAlreadyExists::create($job_id);
        }

        return static::query()->create(compact(
            'customer_id',
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
     * Get the customer that owns the project.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo('Cici\Lieplus\Models\Customer');
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
        return $this->customer->name;
    }

    public function getCompanyLevelAttribute()
    {
        return $this->customer->level;
    }

    public function getCompanyTypeAttribute()
    {
        return $this->customer->type;
    }

    public function scopeCompanyName($query, $name)
    {
        return $query->whereHas('customer', function ($query) use ($name) {
            return $query->where('name', 'like', '%' . $name . '%');
        });
    }

    public function scopeJobName($query, $name)
    {
        return $query->whereHas('job', function ($query) use ($name) {
            return $query->where('name', 'like', '%' . $name . '%');
        });
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
