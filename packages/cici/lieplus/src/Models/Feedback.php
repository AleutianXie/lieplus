<?php
namespace Cici\Lieplus\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Feedback model instance
 */
class Feedback extends Model
{
    use SoftDeletes;

    protected $fillable = ['text', 'created_by'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable('feedbacks');
    }

    /**
     * Create feed back
     */
    public static function create(array $attributes = [])
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

    /**
     * Get the resume that owns the feedback.
     */
    public function resume() : BelongsTo
    {
        return $this->belongsTo('Cici\Liplus\Models\Resume');
    }
}
