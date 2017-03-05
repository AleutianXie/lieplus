<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'resume'], function() {
    Route::get('/', 'ResumeController@index');
    Route::get('/index', 'ResumeController@index');
    Route::match(['get', 'post'], '/add', 'ResumeController@add');
    Route::match(['get', 'post'], '/{id}', 'ResumeController@detail')->where('id', '[0-9]+');
    Route::match(['get', 'post'],'/edit', 'ResumeController@edit');
    Route::get('/my', 'ResumeController@mylibrary');
    Route::get('/all', 'ResumeController@all');
    Route::post('/feedback', 'FeedbackController@add');
});

Route::group(['prefix' => 'alert'], function() {
    //Route::get('/', 'CustomerController@index');
    //Route::get('/index', 'CustomerController@index');
    Route::get('/{id}/{rid}', 'AlertController@edit')->where(['id' => '[0-9]+', 'rid' => '[0-9]+']);
    Route::get('/add/{rid}', 'AlertController@add')->where('rid', '[0-9]+');
    Route::match(['get', 'post'], '/save', 'AlertController@save');
});

Route::group(['prefix' => 'customer'], function() {
    Route::get('/', 'CustomerController@index');
    Route::get('/index', 'CustomerController@index');

});

Route::group(['prefix' => 'line'], function() {
    Route::get('/', 'LineController@index');
    Route::get('/index', 'LineController@index');

});

Route::group(['prefix' => 'project'], function() {
    Route::get('/', 'ProjectController@index');
    Route::get('/index', 'ProjectController@index');
});