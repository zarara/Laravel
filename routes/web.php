<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('content.log.login');
});
Route::get('dashboard', 'DashController@index');

// ------------------- Pendaftar -------------------

Route::group(['middleware' => ['web']], function () {
    Route::get('pendaftar', ['as' => 'viewPendaftar', 'uses' => 'PendaftarController@index']);
    Route::get('/pendaftar/create', "PendaftarController@create");
    Route::post('/pendaftar/store', "PendaftarController@store");
});

// ------------------- Phonebook -------------------

Route::group(['middleware' => ['web']], function () {
    Route::get('phone', ['as' => 'viewPhonebook', 'uses' => 'PhonebookController@index']);
    Route::patch('phone_update/{id}', ['as' => 'viewPhonebook', 'uses' => 'PhonebookController@update']);
});

// ------------------- Group -------------------

Route::group(['middleware' => ['web']], function () {
    Route::get('group', ['as' => 'viewGroup', 'uses' => 'GroupController@index']);
    Route::get('refresh', 'GroupController@addGroup');
});

// ------------------- Create Message -------------------

Route::get('cpersonal', 'PersonalController@index');
Route::get('cgroup', 'MessageGroupController@index');

// ------------------- Create Template Message -------------------

Route::group(['middleware' => ['web']], function () {
    Route::get('template', 'TemplateController@index');
});

// ------------------- Create Message Schedule -------------------

Route::group(['middleware' => ['web']], function () {
    Route::get('cschedule', ['as' => 'viewScheduled', 'uses' => 'ScheduledController@index']);
    Route::get('schedule_create', 'ScheduledController@create');
    Route::resource('cschedule', 'ScheduledController');
});

// ------------------- Send Message   -------------------
Route::post('send', 'MessageSendController@sendMessage');
Route::post('sendGroup', 'MessageSendController@sendMessageGroup');
Route::post('sendSchedule', 'MessageSendController@sendMessageScheduler');

// ------------------- Outbox   -------------------
Route::get('outbox', 'OutboxController@index');




Auth::routes();
Route::get('/home', 'HomeController@index');
