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
//Route::get('/', 'ResumeController@mylibrary')->name('front');

Auth::routes();

/* 首页 */
Route::get('/', [
    'middleware' => ['auth'],
    'uses'       => function () {
        if (Auth::user()) {
            return redirect('/resume');
        }
    },
    'as'         => 'home'
]);

// lieplus
Route::group(['middleware' => ['auth']], function () {
    // resume
    Route::get('resume/{index?}', 'ResumeController@index')->where('index', 'index')->name('resume');
    Route::match(['get', 'post'], 'resume/create', 'ResumeController@create')->name('resume.create');
    Route::get('resume/{id}/{tab?}', 'ResumeController@detail')->where('id', '[0-9]+')->where('tab', 'job|feedback|notice')->name('resume.detail');
    Route::get('resume/my', 'ResumeController@my')->name('resume.my');
    Route::get('resume/job/{id?}', 'ResumeController@job')->where(['id' => '[0-9]+'])->name('resume.job');
    Route::get('resume/all', 'ResumeController@all')->name('resume.all');
    Route::get('resumes', 'ResumeController@search')->name('resume.search');
    Route::match(['get', 'post'], 'resume/{id}/edit', 'ResumeController@edit')->where(['id' => '[0-9]+'])->name('resume.edit');
    Route::post('resume/my/add/{id}', 'ResumeController@addMy')->where(['id' => '[0-9]+'])->name('resume.addmy');
    Route::get('resume/lines', 'ResumeController@lines')->name('resume.line');
    Route::post('resume/job/add', 'ResumeController@addJob')->name('resume.addjob');
    //Route::get('/search/{type}', 'ResumeController@search')->where(['type' => 'my|all|job'])->name('resume.search');
    Route::post('/feedback', 'FeedbackController@add');

    // customer

    Route::get('customer/search', 'CustomerController@search')->name('customer.search');

    // job

    Route::get('job/search', 'JobController@search')->name('job.search');
});

Route::group(['prefix' => 'alert',  'middleware' => ['auth']], function ()
{
    //Route::get('/', 'CustomerController@index');
    //Route::get('/index', 'CustomerController@index');
    Route::get('/{id}/{rid}', 'AlertController@edit')->where(['id' => '[0-9]+', 'rid' => '[0-9]+']);
    Route::get('/add/{rid}', 'AlertController@add')->where('rid', '[0-9]+');
    Route::match(['get', 'post'], '/save', 'AlertController@save');
});

Route::group(['prefix' => 'customer', 'middleware' => ['auth']], function ()
{
    Route::get('/', 'CustomerController@index')->name('customer');
    Route::get('/index', 'CustomerController@index')->name('customer.index');
    Route::get('/all', 'CustomerController@all')->name('customer.all');
    Route::match(['get', 'post'], '/{id}', 'CustomerController@detail')->where('id', '[0-9]+')->name('customer.detail');
    Route::match(['get', 'post'], '/audit/{id}', 'CustomerController@audit')->where('id', '[0-9]+');
    Route::match(['get', 'post'], '/add', 'CustomerController@add');
    Route::post('/edit', 'CustomerController@edit');
    Route::post('/check', 'CustomerController@isExist');

    Route::post('/pause/{jid}', 'CustomerController@pause')->where('id', '[0-9]+')->name('customer.pause');
    Route::post('/open/{jid}', 'CustomerController@open')->where('id', '[0-9]+')->name('customer.open');
    Route::post('/assign', 'CustomerController@assign')->name('customer.assign');
    Route::get('/assignmodal/{cid}/{aid?}', 'CustomerController@assignmodal')->where('cid', '[0-9]+')->where('aid', '[0-9]+')->name('customer.assign.modal');

});

Route::group(['prefix' => 'job', 'middleware' => ['auth']], function ()
{
    Route::get('/', 'JobController@index')->name('job');
    Route::get('/index', 'JobController@index')->name('job.index');
    Route::get('/all', 'JobController@all')->name('job.all');
    Route::match(['get', 'post'], '/{id}', 'JobController@detail')->where('id', '[0-9]+')->name('job.detail');
    Route::match(['get', 'post'], '/audit/{id}', 'JobController@audit')->where('id', '[0-9]+');
    Route::match(['get', 'post'], '/create', 'JobController@create')->name('job.create');

    Route::post('/edit', 'JobController@edit');
    Route::post('/pause/{jid}', 'JobController@pause')->where('id', '[0-9]+')->name('job.pause');
    Route::post('/open/{jid}', 'JobController@open')->where('id', '[0-9]+')->name('job.open');
});

Route::group(['prefix' => 'line', 'middleware' => ['auth']], function ()
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

Route::group(['prefix' => 'project', 'middleware' => ['auth']], function ()
{
    Route::match(['get', 'post'], '/', 'ProjectController@index')->name('project');
    Route::match(['get', 'post'], '/index', 'ProjectController@index')->name('project.index');
    Route::match(['get', 'post'], '/audit', 'ProjectController@audit')->name('project.audit');
    Route::post('/edit', 'ProjectController@edit');
    Route::match(['get', 'post'], '/{id}', 'ProjectController@detail')->where('id', '[0-9]+')->name('project.detail');
    Route::get('/search/{type}', 'ProjectController@search')->where(['type' => 'all'])->name('project.search');
});

Route::group(['prefix' => 'station', 'middleware' => ['auth']], function ()
{
    Route::post('/next/{lid}/{rid}', 'StationController@next')->where(['lid' => '[0-9]+', 'rid' => '[0-9]+'])->name('station.next');
    Route::post('/abandon/{lid}/{rid}', 'StationController@abandon')->where(['lid' => '[0-9]+', 'rid' => '[0-9]+'])->name('station.abandon');
    Route::post('/reactive/{lid}/{rid}', 'StationController@reactive')->where(['lid' => '[0-9]+', 'rid' => '[0-9]+'])->name('station.reactive');
    Route::post('/create/{lid}/{rid}', 'StationController@create')->where(['lid' => '[0-9]+', 'rid' => '[0-9]+'])->name('station.create');
});

Route::group(['prefix' => 'plan', 'middleware' => ['auth']], function ()
{
    Route::get('/', 'PlanController@index')->name('line.plan');
    Route::post('/add', 'PlanController@add')->name('line.plan.add');
    Route::get('/stations/{status}', 'PlanController@getStations')->where(['status', '[1-8]?'])->name('line.plan.search');
});

// user
Route::group(['prefix' => 'user', 'middleware' => ['auth']], function ()
{
    Route::match(['get', 'post'], '/{index?}', 'UserController@index')->where('index', 'index')->name('user.index');
    // for user profile
    Route::match(['get', 'post'], '/{id}/{tab?}', 'UserController@detail')->where('id', '[0-9]+')->where('tab', 'index|setting|password')->name('user.detail');
    Route::post('/edit', 'UserController@edit')->where('id', '[0-9]+')->name('user.edit');
    Route::post('/branch/add', 'UserController@addBranch')->name('user.addbranch');
//Route::post('/role/add', 'RoleController@add');
    Route::post('/user/department/edit', 'UserDepartmentController@edit');
//Route::post('/role/edit', 'RoleController@edit');
    Route::match(['get', 'post'], '/addrole', 'UserController@addRole')->name('user.addrole');
});
