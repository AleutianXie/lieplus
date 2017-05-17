<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = 'regions';

    //
    public static function Address()
    {
        self::provinces();
        self::cities();
        self::counties();
    }

    private static function provinces()
    {
        if (empty(config('lieplus.provinces'))) {

            $provinces = static::where(['type' => 1, 'show' => 1])->get(['code', 'name']);

            $provinces = array_pluck($provinces, 'name', 'code');

            config(['lieplus.provinces' => $provinces]);
        }
    }

    private static function cities()
    {
        if (empty(config('lieplus.cities'))) {
            $cities = [];

            foreach (static::where(['type' => 2, 'show' => 1])->get(['code', 'name', 'parent'])->toArray() as $key => $value) {
                $cities[$value['parent']][$value['code']] = $value['name'];
                unset($value);
            }
            config(['lieplus.cities' => $cities]);
        }
    }

    private static function counties()
    {
        if (empty(config('lieplus.counties'))) {
            $counties = [];
            foreach (static::where(['type' => 3, 'show' => 1])->get(['code', 'name', 'parent'])->toArray() as $key => $value) {
                $counties[$value['parent']][$value['code']] = $value['name'];
                unset($value);
            }
            config(['lieplus.counties' => $counties]);
        }
    }

    public static function name($code)
    {
        return static::where(['code' => $code])->get(['name'])[0]->name;
    }
}
