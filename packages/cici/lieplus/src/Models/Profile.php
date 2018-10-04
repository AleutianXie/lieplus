<?php
namespace Cici\Lieplus\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Base
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'number', 'avatar', 'birthdate', 'gender', 'mobile', 'branch_id', 'created_by', 'updated_by'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable('profiles');
    }
}
