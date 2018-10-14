<?php

use Cici\Lieplus\Models\Region;
use Cici\Lieplus\Models\Department;

// regions
Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/provinces', function () {
        $region = Region::getInstance();
        return $region->getProvinces();
    })->name('get.provinces');

    Route::get('province/{province}/cities', function ($province) {
        $region = Region::getInstance();
        return $region->getCities($province);
    })->name('get.cities');

    Route::get('/city/{city}/counties', function ($city) {
        $region = Region::getInstance();
        return $region->getCounties($city);
    })->name('get.counties');

    Route::get('/custome/{customer_id}/deparments', function ($customer_id) {
        return Department::where(compact('customer_id'))->pluck('name', 'id')->toArray();
    })->name('get.departments');
});
