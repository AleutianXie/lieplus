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
        $rid     = Arr::get($params, 'rid');
        $text    = Arr::get($params, 'text');
        $creater = Arr::get($params, 'creater');
        if (empty($rid) || empty($text) || empty($creater)) {
            throw new InvalidArgumentException;
        }
         {
            throw ResumeNotExists::create($rid);
        }

        return parent::create($params);
    }
}
