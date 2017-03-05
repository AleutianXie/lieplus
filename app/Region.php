<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = 'regions';

    //
    public static function getProvinces()
    {
        $provinces = [];
        foreach (static::where(['type' => 1, 'show' => 1])->get(['code', 'name'])->toArray() as $key => $value) {
            $provinces[$value['code']] = $value['name'];
            unset($value);
        }
        return $provinces;
    }

    public static function getCities()
    {
        $cities = [];
        foreach (static::where(['type' => 2, 'show' => 1])->get(['code', 'name', 'parent'])->toArray() as $key => $value) {
            $cities[$value['parent']][$value['code']] = $value['name'];
            unset($value);
         }
        return $cities;
    }

    public static function getCounties()
    {
        $counties = [];
        foreach (static::where(['type' => 3, 'show' => 1])->get(['code', 'name', 'parent'])->toArray() as $key => $value) {
            $counties[$value['parent']][$value['code']] = $value['name'];
            unset($value);
        }
        return $counties;
    }

    public static function name($code)
    {
        return static::where(['code' => $code])->get(['name'])[0]->name;
    }
}
