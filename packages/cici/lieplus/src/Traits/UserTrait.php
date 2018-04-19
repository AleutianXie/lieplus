<?php
namespace Cici\Lieplus\Traits;

use App\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Query\Expression;

trait UserTrait
{
    /**
     * A resume may be given various users.
     */
    public function users() : BelongsToMany
    {
        return $this->belongsToMany(
            'App\User',
            'user_has_'.snake_case(str_plural(class_basename(static::class)))
        );
    }

    /**
     * Assign the given user to the model.
     *
     * @param array ...$users
     *
     * @return $this
     */
    public function assignUser($attributes = [], ...$users)
    {
        $user_ids = $this->users()->pluck('user_id')->toArray();

        $users = collect($users)
            ->flatten()
            ->filter(function ($id) use ($user_ids) {
                return !in_array($id, $user_ids);
            })
            ->map(function ($id) {
                return User::findorFail($id);
            })
            ->all();

        return $this->users()->withTimestamps()->withPivotValue($attributes)->saveMany($users);
    }

    /**
     * Revoke the given user from the model.
     *
     * @param string|\Spatie\Permission\Contracts\Role $role
     */
    public function removeUser($user)
    {
        $this->users()->detach($user);
    }
}
