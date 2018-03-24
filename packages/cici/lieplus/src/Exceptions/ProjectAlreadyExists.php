<?php

namespace Cici\Lieplus\Exceptions;

use InvalidArgumentException;

class ProjectAlreadyExists extends InvalidArgumentException
{
    //
    public static function create(string $job_id)
    {
        return new static("A `{$job_id}` project already exists.");
    }
}
