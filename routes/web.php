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
Route::get('/', 'ResumeController@mylibrary');

Auth::routes();

Route::get('/home', ['as' => 'home', 'uses' => 'HomeController@index']);

Route::get('/getuser', ['as' => 'home.get', 'uses' => 'HomeController@getuser']);

Route::group(['prefix' => 'resume'], function ()
{
    Route::get('/', ['as' => 'resume', 'uses' => 'ResumeController@index']);
    Route::get('/index', 'ResumeController@index');
    Route::match(['get', 'post'], '/add', ['as' => 'resume.add', 'uses' => 'ResumeController@add']);
    Route::match(['get', 'post'], '/{id}', ['as' => 'resume.detail', 'uses' => 'ResumeController@detail'])->where('id', '[0-9]+');
    Route::match(['get', 'post'], '/edit', 'ResumeController@edit');
    Route::get('/my', ['as' => 'resume.my', 'uses' => 'ResumeController@mylibrary']);
    Route::post('/my/add/{id}', 'ResumeController@addmy')->where(['id' => '[0-9]+'])->name('resume.addmy');
    Route::get('/jobmodal/{id}', 'ResumeController@jobmodal')->where('id', '[0-9]+')->name('resume.jobmodal');
    Route::post('/job/add/', 'ResumeController@addjob')->name('resume.addjob');
    Route::get('/job', ['as' => 'resume.job', 'uses' => 'ResumeController@joblibrary']);
    Route::get('/all', ['as' => 'resume.all', 'uses' => 'ResumeController@all']);
    Route::get('/search/{type}', 'ResumeController@search')->where(['type' => 'my|all|job'])->name('resume.search');
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
    Route::get('/', 'CustomerController@index')->name('customer');
    Route::get('/index', 'CustomerController@index')->name('customer.index');
    Route::get('/all', 'CustomerController@all')->name('customer.all');
    Route::match(['get', 'post'], '/{id}', 'CustomerController@detail')->where('id', '[0-9]+')->name('customer.detail');
    Route::match(['get', 'post'], '/audit/{id}', 'CustomerController@audit')->where('id', '[0-9]+');
    Route::match(['get', 'post'], '/add', 'CustomerController@add');
    Route::post('/edit', 'CustomerController@edit');
    Route::post('/check', 'CustomerController@isExist');
    Route::get('/search/{type}', 'CustomerController@search')->where(['type' => 'my|all'])->name('customer.search');
    Route::post('/pause/{jid}', 'CustomerController@pause')->where('id', '[0-9]+')->name('customer.pause');
    Route::post('/open/{jid}', 'CustomerController@open')->where('id', '[0-9]+')->name('customer.open');
    Route::post('/assign', 'CustomerController@assign')->name('customer.assign');
    Route::get('/assignmodal/{cid}/{aid?}', 'CustomerController@assignmodal')->where('cid', '[0-9]+')->where('aid', '[0-9]+')->name('customer.assign.modal');

});

Route::group(['prefix' => 'job'], function ()
{
    Route::get('/', 'JobController@index')->name('job');
    Route::get('/index', 'JobController@index')->name('job.index');
    Route::get('/all', 'JobController@all')->name('job.all');
    Route::match(['get', 'post'], '/{id}', 'JobController@detail')->where('id', '[0-9]+')->name('job.detail');
    Route::match(['get', 'post'], '/audit/{id}', 'JobController@audit')->where('id', '[0-9]+');
    Route::match(['get', 'post'], '/add', 'JobController@add')->name('job.add');
    Route::get('/search/{type}', 'JobController@search')->where(['type' => 'my|all'])->name('job.search');
    Route::post('/edit', 'JobController@edit');
    Route::post('/pause/{jid}', 'JobController@pause')->where('id', '[0-9]+')->name('job.pause');
    Route::post('/open/{jid}', 'JobController@open')->where('id', '[0-9]+')->name('job.open');
});

Route::group(['prefix' => 'line'], function ()
{
    Route::get('/', 'LineController@index')->name('line');
    Route::get('/index', 'LineController@index')->name('line.index');
    Route::post('/add', 'LineController@add')->name('line.add');
    Route::match(['get', 'post'], '/{id}', 'LineController@detail')->where('id', '[0-9]+')->name('line.detail');
    Route::match(['get', 'post'], '/edit', 'LineController@edit');
    Route::get('/my', 'LineController@my')->name('line.my');
    Route::get('/customer', 'LineController@customer')->name('line.customer');
    Route::get('/job', 'LineController@job');
    Route::get('/all', 'LineController@all')->name('line.all');
    Route::match(['get', 'post'], '/assign/{lid}', 'LineController@assign')->where('lid', '[0-9]+')->name('line.assign');
    Route::get('/search/{type}', 'LineController@search')->where(['type' => 'my|all|customer'])->name('line.search');
    Route::get('/stations/{lid}/{status}', 'LineController@getStations')->where(['lid' => '[0-9]+', 'status' => '[0-8]?'])->name('line.detail.stations');
});

Route::group(['prefix' => 'project'], function ()
{
    Route::match(['get', 'post'], '/', 'ProjectController@index')->name('project');
    Route::match(['get', 'post'], '/index', 'ProjectController@index')->name('project.index');
    Route::match(['get', 'post'], '/audit', 'ProjectController@audit')->name('project.audit');
    Route::post('/edit', 'ProjectController@edit');
    Route::match(['get', 'post'], '/{id}', 'ProjectController@detail')->where('id', '[0-9]+')->name('project.detail');
    Route::get('/search/{type}', 'ProjectController@search')->where(['type' => 'all'])->name('project.search');
});

Route::group(['prefix' => 'station'], function ()
{
    Route::post('/next/{lid}/{rid}', 'StationController@next')->where(['lid' => '[0-9]+', 'rid' => '[0-9]+'])->name('station.next');
    Route::post('/abandon/{lid}/{rid}', 'StationController@abandon')->where(['lid' => '[0-9]+', 'rid' => '[0-9]+'])->name('station.abandon');
    Route::post('/reactive/{lid}/{rid}', 'StationController@reactive')->where(['lid' => '[0-9]+', 'rid' => '[0-9]+'])->name('station.reactive');
    Route::post('/create/{lid}/{rid}', 'StationController@create')->where(['lid' => '[0-9]+', 'rid' => '[0-9]+'])->name('station.create');
});

Route::group(['prefix' => 'plan'], function ()
{
    Route::get('/', 'PlanController@index')->name('line.plan');
    Route::post('/add', 'PlanController@add')->name('line.plan.add');
    Route::get('/stations/{status}', 'PlanController@getStations')->where(['status', '[1-8]?'])->name('line.plan.search');
});

// for user profile
Route::match(['get', 'post'], '/user/{id}', ['as' => 'user.profile', 'uses' => 'UserController@detail'])->where('id', '[0-9]+');
Route::post('/user/edit', ['as' => 'user.edit', 'uses' => 'UserController@edit'])->where('id', '[0-9]+');
Route::post('/user/department/add', 'UserDepartmentController@add');
//Route::post('/role/add', 'RoleController@add');
Route::post('/user/department/edit', 'UserDepartmentController@edit');
//Route::post('/role/edit', 'RoleController@edit');

// admin
Route::group(['prefix' => 'admin'], function ()
{
    Route::match(['get', 'post'], '/', ['as' => 'admin', 'uses' => 'UserController@index']);
    Route::match(['get', 'post'], '/index', ['as' => 'admin.index', 'uses' => 'UserController@index']);
    Route::match(['get', 'post'], '/addrole', 'UserController@addrole');
});
