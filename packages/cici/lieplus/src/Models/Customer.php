<?php
namespace Cici\Lieplus\Models;

use Cici\Lieplus\Exceptions\NameAlreadyExists;
use Cici\Lieplus\Models\Department;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * Customer model instance
 */
class Customer extends Base
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable('customers');
    }

    public $guarded = ['id'];

    public static function create(array $attributes)
    {
        $name            = $attributes['name'];
        $province        = $attributes['province'];
        $city            = $attributes['city'];
        $county          = $attributes['county'];
        $welfare         = $attributes['welfare'];
        $work_time       = $attributes['work_time'];
        $founder         = empty($attributes['founder']) ? '' : $attributes['founder'];
        $financing       = $attributes['financing'];
        $industry        = $attributes['industry'];
        $ranking         = $attributes['ranking'];
        $property        = $attributes['property'];
        $size            = $attributes['size'];
        $introduce       = $attributes['introduce'];
        $level           = $attributes['level'];
        $type            = $attributes['type'];
        $status          = $attributes['status'];
        $created_by      = $attributes['created_by'];
        $updated_by      = $attributes['updated_by'];

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
        return $this->hasMany(
            'Cici\Lieplus\Models\Department'
        );
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
            ->filter(function($id) use ($department_ids) {
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
}
