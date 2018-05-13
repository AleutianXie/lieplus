<?php
namespace Cici\Lieplus\Traits;

use Cici\Lieplus\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Expression;

trait CustomerTrait
{
    /**
     * A model may have multiple customers.
     */
    public function customers()
    {
        return $this->belongsToMany(
            'Cici\Lieplus\Models\Customer',
            'user_has_customers'
        );
    }

    /**
     * Assign the given customers to the model.
     *
     * @param array ...$customers
     *
     * @return $this
     */
    public function assignCustomers(...$customers)
    {
        $customer_ids = $this->customers()->pluck('customer_id')->toArray();

        $customers = collect($customers)
            ->flatten()
            ->filter(function ($customer) use ($customer_ids) {
                return !in_array($customer, $customer_ids);
            })
            ->map(function ($customer) {
                return Customer::findOrFail($customer);
            })
            ->all();

        $this->customers()->saveMany($customers);

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
