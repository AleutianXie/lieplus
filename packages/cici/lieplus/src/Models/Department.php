<?php

namespace Cici\Lieplus\Models;

use Cici\Lieplus\Exceptions\NameAlreadyExists;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

/**
 * Department model instance
 */
class Department extends Base
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable('departments');
    }

    public $guarded = ['id'];

    public static function create(array $attributes)
    {
        $customer_id = $attributes['customer_id'];
        $name = $attributes['name'];
        $created_by = Auth::id();
        $updated_by = Auth::id();

        if (static::getDepartments()->where('customer_id', $customer_id)->where('name', $name)->first()) {
            throw NameAlreadyExists::create($name);
        }

        return static::query()->create(compact(
            'customer_id',
            'name',
            'created_by',
            'updated_by'
        ));
    }

    /**
     * Get the customer that owns the department.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo('Cici\Lieplus\Models\Customer');
    }

    /**
     * Get the job that belongs to the department.
     */
    public function job(): HasOne
    {
        return $this->hasOne('Cici\Liplus\Models\Job');
    }

    /**
     * Get the current cached department.
     */
    protected static function getDepartments(): Collection
    {
        return app(Department::class)->get();
    }
}
