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

Route::get('/home', 'HomeController@index')->name('home');

Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function(){
    Route::middleware('can:manage_users')->group(function(){
        Route::resource('/users', 'UsersController'); //URL to access, followed by controller created
        
    });
 
    //Needs to be given its own middleware
    Route::resource('/courses', 'CoursesController');
    Route::resource('/appointments', 'AppointmentsController');
    Route::resource('/meetings', 'MeetingsController');
    Route::resource('/services', 'ServicesController');

    Route::get('get-users', 'UsersController@GetUsers');


           
 
});


