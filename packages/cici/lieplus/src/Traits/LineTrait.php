<?php
namespace Cici\Lieplus\Traits;

use Cici\Lieplus\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Expression;

trait LineTrait
{
    /**
     * A model may have multiple lines.
     */
    public function lines()
    {
        return $this->belongsToMany(
            'Cici\Lieplus\Models\Line',
            snake_case(class_basename(static::class)).'_has_lines'
        );
    }

    /**
     * Assign the given lines to the model.
     *
     * @param array ...$lines
     *
     * @return $this
     */
    public function assignLines(...$lines)
    {
        $line_ids = $this->lines()->pluck('line_id')->toArray();

        $lines = collect($lines)
            ->flatten()
            ->filter(function ($line) use ($line_ids) {
                return !in_array($line, $line_ids);
            })
            ->map(function ($line) {
                return Line::findOrFail($line);
            })
            ->all();

        $this->lines()->saveMany($lines);

        return $this;
    }

    /**
     * Revoke the given role from the model.
     *
     * @param string|\Spatie\Permission\Contracts\Role $role
     */
    // public function removeRole($role)
    // {
    //     $this->roles()->detach($this->getStoredRole($role));
    // }

    // protected function getStoredRole($role): Role
    // {
    //     if (is_numeric($role)) {
    //         return app(Role::class)->findById($role);
    //     }

    //     if (is_string($role)) {
    //         return app(Role::class)->findByName($role);
    //     }

    //     return $role;
    // }
}
