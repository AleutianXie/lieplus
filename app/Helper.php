<?php

namespace App;

/**
* Help Class
*/
class Helper
{

    function __construct()
    {
        # code...
    }

    public static function generationSN($prefix = '')
    {
        return strtoupper($prefix).date('YmdHis', time()).sprintf('%04d', mt_rand(0, 9999));
    }

    
}