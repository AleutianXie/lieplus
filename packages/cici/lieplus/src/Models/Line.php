<?php
namespace Cici\Lieplus\Models;

use Cici\Lieplus\Exceptions\NameAlreadyExists;
use Cici\Lieplus\Traits\UserTrait;
use Illuminate\Support\Collection;

/**
 * Line model instance
 */
class Line extends Base
{
    use UserTrait;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable('lines');
    }

    public $guarded = ['id'];

    public static function create(array $attributes)
    {
        $customer_id     = $attributes['customer_id'];
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

        if (static::getJobs()->where(['department_id', $department_id, 'name', $name])->first()) {
            throw NameAlreadyExists::create($name);
        }

        return static::query()->create(compact(
            'customer_id',
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
     * A resume can be applied to roles.
     */
    // public function feedbacks(): BelongsToMany
    // {
    //     return $this->belongsToMany(
    //         config('permission.models.role'),
    //         config('permission.table_names.role_has_permissions')
    //     );
    // }

    /**
     * Get the current cached job.
     */
    protected static function getLines(): Collection
    {
        return app(Line::class)->get();
    }
}
