<?php

namespace Cici\Lieplus\Exceptions;

use InvalidArgumentException;

class ResumeNotExists extends InvalidArgumentException
{
    //
    public static function create(string $resume)
    {
        return new static("`{$resume}` resume not exists.");
    }
}
