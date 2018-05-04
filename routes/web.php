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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/about', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout' , 'Auth\LoginController@logout');

Route::get('/', 'NominationsController@home');
Route::get('api/v1/nominations', 'NominationsController@index');
Route::get('api/v1/nominations/{id}/edit', 'NominationsController@edit');
Route::post('api/v1/nominations/{id}', 'NominationsController@update');
Route::delete('api/v1/nominations/{id}', 'NominationsController@destroy');
Route::post('api/v1/nominations', 'NominationsController@store');


// Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function () {
//     Route::resource('nominations', 'NominationsController', ['except' => ['create', 'edit']]);
// });


// Route::get('/admin', function () {
//     return view('admin');
//     })->middleware('admin','auth');

// Route::prefix('admin')->middleware('admin','auth')->group(function () {

//     Route::get('', function () {
//         return view('admin');
//         });
//     Route::get('users', function () {
//             // Matches The "/admin/users" URL
//         return view('admin');
//         });
//     });

    Route::group(['prefix' => 'admin',  'middleware' => 'auth','admin'], function()
    {
        Route::get('/', function() {
            return view('admin');
        })->name('admin');

        Route::get('/user', 'AdminController@indexUsers')->name('user');
    });