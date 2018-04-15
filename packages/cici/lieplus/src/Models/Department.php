<?php
namespace Cici\Lieplus\Models;

use Cici\Lieplus\Exceptions\NameAlreadyExists;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;

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
        $customer_id     = $attributes['customer_id'];
        $name            = $attributes['name'];
        $created_by      = $attributes['created_by'];
        $updated_by      = $attributes['updated_by'];

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
    public function customer() : BelongsTo
    {
        return $this->belongsTo('Cici\Liplus\Models\Customer');
    }

    /**
     * Get the current cached department.
     */
    protected static function getDepartments(): Collection
    {
        return app(Department::class)->get();
    }
}
