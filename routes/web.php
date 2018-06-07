<?php


Route::get('/about', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/logout' , 'Auth\LoginController@logout');

Route::get('/', 'NominationsController@home');
Route::get('api/v1/nominations', 'NominationsController@index');
Route::get('api/v1/nominations/{id}/edit', 'NominationsController@edit');
Route::post('api/v1/nominations/{id}', 'NominationsController@update');
Route::delete('api/v1/nominations/{id}', 'NominationsController@destroy');
Route::post('api/v1/nominations', 'NominationsController@store');


Route::group(['prefix' => 'admin',  'middleware' => ['auth','admin']], function()
    {
        Route::get('/', function() {
            return view('admin');
        })->name('admin');

        Route::get('/user', 'AdminController@indexUsers')->name('user');
        Route::get('/user/api', function () {
            return $users=App\User::with(['profile'])->get();
        });
    });
    
Route::group(['prefix' => 'dashboard', 'middleware' => ['auth']], function(){
    Route::group(['middleware' => ['profile']], function(){
        Route::get('/', 'HomeController@index')->name('home');
    
        Route::get('nominations', function() {
            $count = \App\Nomination::where('user_id','=',auth()->id())->count();
            return view('layouts.member.nomination')->with('count',$count);
        });
    });

    Route::get('profile', function() {
        return view('layouts.member.updateprofile');
    });
});

Route::group(['prefix' => 'api/v1', 'middleware' => ['auth']], function(){
    Route::post('/profile', 'ProfileController@store');
    Route::get('/profile', 'ProfileController@show');
});

