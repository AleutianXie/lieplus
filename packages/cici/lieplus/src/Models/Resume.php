<?php
namespace Cici\Lieplus\Models;

use Cici\Lieplus\Exceptions\EmailAlreadyExists;
use Cici\Lieplus\Exceptions\MobileAlreadyExists;
use Illuminate\Support\Collection;

/**
 * Resume model instance
 */
class Resume extends Base
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable('resumes');
    }

    public $guarded = ['id'];

    public static function create(array $attributes)
    {
        $name            = $attributes['name'];
        $mobile          = $attributes['mobile'];
        $email           = $attributes['email'];
        $gender          = $attributes['gender'];
        $birthdate       = $attributes['birthdate'];
        $start_work_date = $attributes['start_work_date'];
        $degree          = $attributes['degree'];
        $service_status  = $attributes['service_status'];
        $province        = $attributes['province'];
        $city            = $attributes['city'];
        $county          = $attributes['county'];
        $position        = $attributes['position'];
        $industry        = $attributes['industry'];
        $salary          = $attributes['salary'];
        $others          = $attributes['others'];
        $created_by      = $attributes['created_by'];
        $updated_by      = $attributes['updated_by'];

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
     * A resume can be applied to roles.
     */
    public function feedbacks(): BelongsToMany
    {
        return $this->belongsToMany(
            config('permission.models.role'),
            config('permission.table_names.role_has_permissions')
        );
    }

    /**
     * Get the current cached resume.
     */
    protected static function getResumes(): Collection
    {
        return app(Resume::class)->get();
    }
}
