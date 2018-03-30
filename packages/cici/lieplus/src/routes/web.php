<?php

use Cici\Lieplus\Models\Region;

Route::middleware(['web','auth'])->group(function () {
    Route::get('/provinces', function () {
        $region = Region::getInstance();
        return $region->getProvinces();
    });

    Route::get('province/{province}/cities', function ($province) {
        $region = Region::getInstance();
        return $region->getCities($province);
    });

    Route::get('/city/{city}/counties', function ($city) {
        $region = Region::getInstance();
        return $region->getCounties($city);
    });
});
