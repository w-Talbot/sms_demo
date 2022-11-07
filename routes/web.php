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







    // Test Routes:
    Route::get('/demo/example',function(){
        return view('demo.example');
    });
    Route::get('/manage/index',function(){
        return view('manage.index');
    });
    Route::get('/manage/create',function(){
        return view('manage.create');
    });
    Route::get('/manage/edit',function(){
        return view('manage.edit');
    });


    //DEMO LG
    //All studies
    Route::get('/manage/index', [\App\Http\Controllers\StudyController::class, 'index']);


    //Show create form
    Route::get('/manage/create', [\App\Http\Controllers\StudyController::class, 'create']);

    //Show edit form
    Route::get('/manage/{study}/edit', [\App\Http\Controllers\StudyController::class, 'edit']);

    //Update listing
    Route::put('/manage/{study}',[\App\Http\Controllers\StudyController::class, 'update']);


    //Delete listing
    Route::delete('/manage/{study}',[\App\Http\Controllers\StudyController::class, 'destroy']);


    //Store new study
    Route::post('/manage', [\App\Http\Controllers\StudyController::class, 'store']);



    //Single Study
    Route::get('/manage/{study}',[\App\Http\Controllers\StudyController::class, 'show']);
});


