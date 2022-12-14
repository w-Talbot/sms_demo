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

use App\Study;

Route::get('/', 'Auth\LoginController@showLoginForm')->name('welcome');

Auth::routes();

Route::get('dashboard', 'HomeController@index')->name('home');
Route::get('pricing', 'PageController@pricing')->name('page.pricing');
Route::get('lock', 'PageController@lock')->name('page.lock');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('category', 'CategoryController', ['except' => ['show']]);
    Route::resource('tag', 'TagController', ['except' => ['show']]);
    Route::resource('item', 'ItemController', ['except' => ['show']]);
    Route::resource('role', 'RoleController', ['except' => ['show', 'destroy']]);
    Route::resource('user', 'UserController', ['except' => ['show']]);

    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);

    Route::get('{page}', ['as' => 'page.index', 'uses' => 'PageController@index']);


    //Study Routes
    Route::get('/manage/index', [\App\Http\Controllers\StudyController::class, 'index']);
    Route::get('/manage/create', [\App\Http\Controllers\StudyController::class, 'create']);
    Route::get('/manage/{study}/edit', [\App\Http\Controllers\StudyController::class, 'edit']);
    Route::put('/manage/{study}',[\App\Http\Controllers\StudyController::class, 'update']);
    Route::delete('/manage/{study}',[\App\Http\Controllers\StudyController::class, 'destroy']);
    Route::post('/manage', [\App\Http\Controllers\StudyController::class, 'store']);
    Route::get('/manage/{study}',[\App\Http\Controllers\StudyController::class, 'show']);


    //For testing
//    Route::get('/demo/example', function(){
//        return view('demo.example',[
//            'studies'=> Study::all()
//        ]);
//    });


});


