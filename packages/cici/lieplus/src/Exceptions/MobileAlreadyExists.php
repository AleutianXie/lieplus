<?php

namespace Cici\Lieplus\Exceptions;

use InvalidArgumentException;

class MobileAlreadyExists extends InvalidArgumentException
{
    //
    public static function create(string $mobile)
    {
        return new static("A `{$mobile}` mobile already exists for resume.");
    }
}
