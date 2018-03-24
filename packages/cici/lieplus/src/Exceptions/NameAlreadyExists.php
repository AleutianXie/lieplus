<?php

namespace Cici\Lieplus\Exceptions;

use InvalidArgumentException;

class NameAlreadyExists extends InvalidArgumentException
{
    //
    public static function create(string $name)
    {
        return new static("A `{$name}` name already exists.");
    }
}
