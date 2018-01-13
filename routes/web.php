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
    return view('index');
});

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/student', function () {
    return view('student');
});

//Route::get('/student', 'universityController@getAllUniversities');

Route::get('/staff', function () {
    return view('staff');
});

Route::get('/organization', function () {
    return view('organization');
});

/*Route::get('student/register', function() {
	return view('welcome');
});*/

Route::get('Organization/register', function() {
	return view('welcome');
});

Route::post('staffHome', function() {
	return view('staffHome');
});

Route::post('/staff/login', 'usersController@checkLogin');

Route::post('/staff/register', 'universityController@addUniversity');

Route::post('/student/register', 'usersController@addStudent');

Route::post('/organization/register', 'OrganizationController@addOrganization');
