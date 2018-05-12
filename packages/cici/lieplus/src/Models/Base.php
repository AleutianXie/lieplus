<?php
namespace Cici\Lieplus\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Base extends Model
{
    protected $appends = ['serial_number'];

    public function getserialNumberAttribute()
    {
        return $this->encode($this->id);
    }

    public function encode($id)
    {
        return Str::upper(substr(static::class, strrpos(static::class, '\\') + 1, 1) . str_pad(dechex($id), 9, "0", STR_PAD_LEFT));
    }

    public function decode($id)
    {
        return hexdec(substr(id, 1));
    }
}
