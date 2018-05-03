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

Route::resource('/committee', 'CommitteesController');
Route::resource('/user', 'UsersController');
Route::resource('/speaker', 'SpeakersController');
Route::get('/request/inbox', 'RequestsController@inbox');
Route::get('/request/outbox', 'RequestsController@outbox');
Route::resource('/request', 'RequestsController')->except(['create', 'edit']);
Route::get('/request/create/{userId}','RequestsController@create');
Route::get('/task/inbox', 'TasksController@inbox');
Route::get('/task/outbox', 'TasksController@outbox');
Route::resource('/task', 'TasksController')->except(['create', 'edit']);
Route::get('/task/create/{userId}','TasksController@create');
Route::get('/password/change', 'UsersController@changePasswordForm');
Route::get('/chat', 'MessagesController@index');
Route::post('/chat/send', 'MessagesController@send');
Route::get('/chat/receive', 'MessagesController@new');
Route::put('/chat/seeall', 'MessagesController@seeAll');
Route::get('/chat/checksee', 'MessagesController@checkSee');
Route::get('/chat/all', 'MessagesController@getChat');
Route::get('/chat/search', 'MessagesController@chatSearch');
Route::get('/chat/checkcontacts', 'MessagesController@checkContacts');
Route::get('/chat/contacts', 'MessagesController@Contacts');
Route::post('/password/change', 'UsersController@changePassword');

Route::post('/university','UniversitiesController@getColleges');
Route::put('/member/assign','MembersController@assign');
Route::put('/member/head','MembersController@assignHead');
Route::put('/member/unassign','MembersController@unassign');
Route::post('/member/free','MembersController@freeMemebers');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');


Route::put('/workshop/enroll/{guestId}' , 'WorkshopsController@enroll');
Route::put('/event/enroll/{guestId}', 'EventsController@enroll');
Route::resource('/event','EventsController');
Route::resource('/workshop','WorkshopsController');
Route::resource('/sponsor','SponsorsController');


// //All Workshops
// Route::get('/workshop', function(){
//     return view('workshops/workshops');
// });

// //Specific Workshop
// Route::get('/workshop/{id}', function(){
//     return view('workshops/workshop');
// });
