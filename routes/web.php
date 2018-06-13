<?php


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/logout' , 'Auth\LoginController@logout');

// Route::get('/', 'NominationsController@home');
// Route::get('nominations', 'NominationsController@index');
// Route::get('nominations/{id}/edit', 'NominationsController@edit');
// Route::post('nominations/{id}', 'NominationsController@update');
// Route::delete('nominations/{id}', 'NominationsController@destroy');
// Route::post('nominations', 'NominationsController@store');


Route::group(['prefix' => 'admin',  'middleware' => ['auth','admin']], function()
    {
        Route::get('/', function() {
            return view('layouts.admin.index');
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


    Route::get('/nominations', 'NominationsController@index');
    Route::get('/nominations/{id}/edit', 'NominationsController@edit');
    Route::post('/nominations/{id}', 'NominationsController@update');
    Route::delete('/nominations/{id}', 'NominationsController@destroy');
    Route::post('/nominations', 'NominationsController@store');

    Route::post('/messenge', 'MessengeController@store');
    Route::get('/messenge', 'MessengeController@show');
});

