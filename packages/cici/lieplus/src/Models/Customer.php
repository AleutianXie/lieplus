<?php

namespace Cici\Lieplus\Models;

use Cici\Lieplus\Exceptions\NameAlreadyExists;
use Cici\Lieplus\Models\Department;
use Cici\Lieplus\Traits\UserTrait;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

/**
 * Customer model instance
 */
class Customer extends Base
{
    use UserTrait;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable('customers');
    }

    public $guarded = ['id'];
    protected $appends = ['serial_number', 'is_mine', 'adviser', 'options_link'];

    public static function create(array $attributes)
    {
        $name = $attributes['name'];
        $province = $attributes['province'];
        $city = $attributes['city'];
        $county = $attributes['county'];
        $welfare = $attributes['welfare'];
        $work_time = $attributes['work_time'];
        $founder = empty($attributes['founder']) ? '' : $attributes['founder'];
        $financing = $attributes['financing'];
        $industry = $attributes['industry'];
        $ranking = $attributes['ranking'];
        $property = $attributes['property'];
        $size = $attributes['size'];
        $introduce = $attributes['introduce'];
        $level = $attributes['level'];
        $type = $attributes['type'];
        $status = $attributes['status'];
        $created_by = Auth::id();
        $updated_by = Auth::id();

        if (static::getCustomers()->where('name', $name)->first()) {
            throw NameAlreadyExists::create($name);
        }

        return static::query()->create(compact(
            'name',
            'province',
            'city',
            'county',
            'welfare',
            'work_time',
            'founder',
            'financing',
            'industry',
            'ranking',
            'property',
            'size',
            'introduce',
            'level',
            'type',
            'status',
            'created_by',
            'updated_by'
        ));
    }

    /**
     * A customer can have many departments.
     */
    public function departments(): HasMany
    {
        return $this->hasMany('Cici\Lieplus\Models\Department');
    }

    /**
     * A customer can have one project.
     */
    public function project(): HasOne
    {
        return $this->hasOne('Cici\Lieplus\Models\Project');
    }

    public function scopeProjectStatus($query, $status)
    {
        return $query->whereHas('project', function ($query) use ($status) {
            return $query->where('status', $status);
        });
    }

    /**
     * Assign the given departments to the customer.
     *
     * @param array ...$departments
     *
     * @return $this
     */
    public function assignDepartment($attributes = [], ...$departments)
    {
        $department_ids = $this->departments()->pluck('id')->toArray();

        $departments = collect($departments)
            ->flatten()
            ->filter(function ($id) use ($department_ids) {
                return !in_array($id, $department_ids);
            })
            ->map(function ($id) {
                return Department::findorFail($id);
            })
            ->all();

        return $this->departments()->withTimestamps()->withPivotValue($attributes)->saveMany($departments);
    }

    /**
     * Get the current cached customer.
     */
    protected static function getCustomers(): Collection
    {
        return app(Customer::class)->get();
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

        return implode($user_ids->all());
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
