<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Department
 *
 * @mixin \Eloquent
 */
class Department extends Model
{
    //
    public static function get()
    {

        if (empty(config('lieplus.departments')))
        {
            $departments = [];

            foreach (static::where(['show' => 1])->get(['id', 'name', 'cid'])->toArray() as $key => $value)
            {
                $departments[$value['cid']][$value['id']] = $value['name'];
            }
            config(['lieplus.departments' => $departments]);
        }

    }

    public static function name($id)
    {
        return static::where(['id' => $id])->get(['name'])[0]->name;
    }

    public static function getNamesByCid($cid)
    {
        return array_pluck(static::where(['cid' => $cid])->get(['name']), 'name');
    }
}
