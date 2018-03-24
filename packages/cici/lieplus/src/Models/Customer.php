<?php
namespace Cici\Lieplus\Models;

use Cici\Lieplus\Exceptions\NameAlreadyExists;
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
     * Get the current cached customer.
     */
    protected static function getCustomers(): Collection
    {
        return app(Customer::class)->get();
    }
}
