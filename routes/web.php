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

/*Route::get('/', function ()
{
return view('welcome');
});*/
Route::get('/', 'ResumeController@index');

Auth::routes();

Route::get('/home', ['as' => 'home', 'uses' => 'HomeController@index']);

Route::group(['prefix' => 'resume'], function ()
{
    Route::get('/', ['as' => 'resume', 'uses' => 'ResumeController@index']);
    Route::get('/index', 'ResumeController@index');
    Route::match(['get', 'post'], '/add', ['as' => 'resume.add', 'uses' => 'ResumeController@add']);
    Route::match(['get', 'post'], '/{id}', ['as' => 'resume.detail', 'uses' => 'ResumeController@detail'])->where('id', '[0-9]+');
    Route::match(['get', 'post'], '/edit', 'ResumeController@edit');
    Route::get('/my', ['as' => 'resume.my', 'uses' => 'ResumeController@mylibrary']);
    Route::get('/job', ['as' => 'resume.job', 'uses' => 'ResumeController@joblibrary']);
    Route::get('/all', ['as' => 'resume.all', 'uses' => 'ResumeController@all']);
    Route::post('/feedback', 'FeedbackController@add');
});

Route::group(['prefix' => 'alert'], function ()
{
    //Route::get('/', 'CustomerController@index');
    //Route::get('/index', 'CustomerController@index');
    Route::get('/{id}/{rid}', 'AlertController@edit')->where(['id' => '[0-9]+', 'rid' => '[0-9]+']);
    Route::get('/add/{rid}', 'AlertController@add')->where('rid', '[0-9]+');
    Route::match(['get', 'post'], '/save', 'AlertController@save');
});

Route::group(['prefix' => 'customer'], function ()
{
    Route::get('/', 'CustomerController@index');
    Route::get('/index', 'CustomerController@index');
    Route::get('/all', 'CustomerController@all');
    Route::match(['get', 'post'], '/{id}', 'CustomerController@detail')->where('id', '[0-9]+');
    Route::match(['get', 'post'], '/audit/{id}', 'CustomerController@audit')->where('id', '[0-9]+');
    Route::match(['get', 'post'], '/add', 'CustomerController@add');
    Route::post('/edit', 'CustomerController@edit');
    Route::post('/check', 'CustomerController@isExist');
});

Route::group(['prefix' => 'job'], function ()
{
    Route::get('/', 'JobController@index');
    Route::get('/index', 'JobController@index');
    Route::get('/all', 'JobController@all');
    Route::match(['get', 'post'], '/{id}', 'JobController@detail')->where('id', '[0-9]+');
    Route::match(['get', 'post'], '/audit/{id}', 'JobController@audit')->where('id', '[0-9]+');
    Route::match(['get', 'post'], '/add', 'JobController@add');
    Route::post('/edit', 'JobController@edit');

});

Route::group(['prefix' => 'line'], function ()
{
    Route::get('/', 'LineController@index');
    Route::get('/index', 'LineController@index');
    Route::post('/add', 'LineController@add');
    Route::match(['get', 'post'], '/{id}', 'LineController@detail')->where('id', '[0-9]+');
    Route::match(['get', 'post'], '/edit', 'LineController@edit');
    Route::get('/my', 'LineController@my');
    Route::get('/job', 'LineController@job');
    Route::get('/all', 'LineController@all');
    Route::get('/plan', 'LineController@plan');
});

Route::group(['prefix' => 'project'], function ()
{
    Route::match(['get', 'post'], '/', 'ProjectController@index');
    Route::match(['get', 'post'], '/index', 'ProjectController@index');
    Route::match(['get', 'post'], '/audit', 'ProjectController@audit');
    Route::match(['get', 'post'], '/{id}', 'ProjectController@detail')->where('id', '[0-9]+');
});

// for user profile
Route::get('/user/{id}', ['as' => 'user.profile', 'uses' => 'UserController@detail'])->where('id', '[0-9]+');
Route::post('/user/department/add', 'UserDepartmentController@add');
Route::post('/role/add', 'RoleController@add');
Route::post('/user/department/edit', 'UserDepartmentController@edit');
Route::post('/role/edit', 'RoleController@edit');
