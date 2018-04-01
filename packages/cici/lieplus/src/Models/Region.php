<?php
namespace Cici\Lieplus\Models;

use Cici\Lieplus\Exceptions\NameAlreadyExists;
use Illuminate\Support\Collection;

/**
 * Region model instance
 */
class Region extends Base
{
    protected function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable('regions');
    }

    public $guarded = ['id'];

    /**
     * self instance
     */
    private static $_instance;

    public static function getInstance()
    {
        if (!self::$_instance instanceof self) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }

    public function getProvinces()
    {
        return static::where('level', 1)->orderBy('adcode')->pluck('name', 'adcode')->toArray();
    }

    public function getCities($province)
    {
        return static::where('level', 2)->where('adcode', 'like', substr($province, 0, 2).'%')->orderBy('adcode')->pluck('name', 'adcode')->toArray();
    }

    public function getCounties($city)
    {
        return static::where('level', 3)->where('adcode', 'like', substr($city, 0, 4).'%')->orderBy('adcode')->pluck('name', 'adcode')->toArray();
    }

    public function getNameByAdcode($adcode)
    {
        return static::where('adcode', $adcode)->first()->name;
    }
}
