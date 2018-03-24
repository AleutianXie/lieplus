<?php
namespace Cici\Lieplus\Models;

use Cici\Lieplus\Exceptions\ProjectAlreadyExists;
use Illuminate\Support\Collection;

/**
 * Project model instance
 */
class Project extends Base
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable('projects');
    }

    public $guarded = ['id'];

    public static function create(array $attributes)
    {
        $job_id          = $attributes['job_id'];
        $customer_id     = $attributes['customer_id'];
        $status          = $attributes['status'];
        $created_by      = $attributes['created_by'];
        $updated_by      = $attributes['updated_by'];

        if (static::getProjects()->where('job_id', $job_id)->first()) {
            throw ProjectAlreadyExists::create($job_id);
        }

        return static::query()->create(compact(
            'job_id',
            'customer_id',
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
     * Get the current cached project.
     */
    protected static function getProjects(): Collection
    {
        return app(Project::class)->get();
    }
}
