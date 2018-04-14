<?php
namespace Cici\Lieplus\Models;

use Cici\Lieplus\Exceptions\ResumeNotExists;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

/**
 * Feedback model instance
 */
class Feedback extends Model
{
    protected $fillable = ['text', 'created_by'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable('feedbacks');
    }

    /**
     * Create feed back
     */
    public static function create(array $params = [])
    {
        $resume_id  = $attributes['resume_id'];
        $text       = $attributes['text'];
        $created_by = $attributes['created_by'];

        return static::query()->create(compact(
            'resume_id',
            'text',
            'created_by'
        ));
    }
}
