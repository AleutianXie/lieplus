<?php

namespace Cici\Lieplus\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Base
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'number', 'name', 'description', 'created_by', 'updated_by'
    ];

    /**
     * Branch constructor.
     * @param array $fillable
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable('branches');
    }
}
