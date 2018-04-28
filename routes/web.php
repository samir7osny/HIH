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

Route::resource('/committee', 'CommitteesController');
Route::resource('/user', 'UsersController');
Route::get('/password/change', 'UsersController@changePasswordForm');
Route::post('/password/change', 'UsersController@changePassword');

Route::post('/university','UniversitiesController@getColleges');
Route::put('/member/assign','MembersController@assign');
Route::put('/member/head','MembersController@assignHead');
Route::put('/member/unassign','MembersController@unassign');
Route::post('/member/free','MembersController@freeMemebers');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::resource('/event','EventsController');
Route::resource('/workshop','WorkshopsController');

// //All Workshops
// Route::get('/workshop', function(){
//     return view('workshops/workshops');
// });

// //Specific Workshop
// Route::get('/workshop/{id}', function(){
//     return view('workshops/workshop');
// });
