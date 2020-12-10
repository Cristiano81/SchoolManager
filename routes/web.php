<?php

use App\Http\Controllers\SchoolYearController;
use Illuminate\Support\Facades\Route;

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
})->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	Route::get('table-list', function () {
		return view('pages.table_list');
	})->name('table');

	Route::get('typography', function () {
		return view('pages.typography');
	})->name('typography');

	Route::get('icons', function () {
		return view('pages.icons');
	})->name('icons');

	Route::get('map', function () {
		return view('pages.map');
	})->name('map');

	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');

	Route::get('rtl-support', function () {
		return view('pages.language');
	})->name('language');

	Route::get('upgrade', function () {
		return view('pages.upgrade');
	})->name('upgrade');
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
    Route::resource('classroom','App\Http\Controllers\ClassroomController');
    Route::resource('student','App\Http\Controllers\StudentController');
    Route::resource('teacher','App\Http\Controllers\TeacherController');
    Route::resource('schoolyear','App\Http\Controllers\SchoolYearController');
    Route::get('schoolyear/details/{id}',['as'=>'schoolyear.details','uses'=>'App\Http\Controllers\SchoolYearController@detail'])->where('id', '[0-9]+');
    Route::get('schoolyear/getClassrooms/{id}',['as'=>'schoolyear.classrooms','uses'=>'App\Http\Controllers\SchoolYearController@getClassrooms'])->where('id', '[0-9]+');
    Route::get('classroom/getTeachers/{id}',['as'=>'classroom.teachers','uses'=>'App\Http\Controllers\ClassroomController@getTeachers'])->where('id', '[0-9]+');
    Route::get('classroom/getStudents/{id}',['as'=>'classroom.students','uses'=>'App\Http\Controllers\ClassroomController@getStudents'])->where('id', '[0-9]+');
});




