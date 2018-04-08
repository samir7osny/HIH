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

// Route::get('/try', function () {
//     return view('welcome');
// });

Route::resource('committee', 'CommitteesController');
Route::resource('user', 'UsersController');

Route::post('/university','UniversitiesController@getColleges');
Route::put('/member/assign','MembersController@assign');
Route::post('/member/free','MembersController@freeMemebers');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

//All Events
Route::get('/event', function(){
    return view('events');
});

//Specific event
Route::get('/event/{id}', function(){
    return view('event');
});

//All Workshops
Route::get('/workshop', function(){
    return view('workshops');
});

//Specific Workshop
Route::get('/workshop/{id}', function(){
    return view('workshop');
});
