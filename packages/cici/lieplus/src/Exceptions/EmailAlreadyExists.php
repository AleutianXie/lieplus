<?php

namespace Cici\Lieplus\Exceptions;

use InvalidArgumentException;

class EmailAlreadyExists extends InvalidArgumentException
{
    //
    public static function create(string $email)
    {
        return new static("A `{$email}` email already exists for resume.");
    }
}
