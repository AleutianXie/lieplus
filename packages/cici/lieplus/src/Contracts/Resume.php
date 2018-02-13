<?php

namespace Cici\Lieplus\Contracts;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

interface Resume
{
    /**
     * A permission can be applied to roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles(): BelongsToMany;

    /**
     * Find a permission by its name.
     *
     * @param string $name
     * @param string|null $guardName
     *
     * @throws \Spatie\Permission\Exceptions\PermissionDoesNotExist
     *
     * @return Permission
     */
    public static function findByName(string $name, $guardName): self;
}
