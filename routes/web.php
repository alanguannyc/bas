<?php
use Carbon\Carbon;
//Home page route
Route::get('/', function () {
    return view('welcome');
})->name('home');

//Auth routes
Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/logout' , 'Auth\LoginController@logout');


//Admin routes
Route::group(['prefix' => 'admin',  'middleware' => ['auth','admin']], function()
    {
        Route::get('/', 'AdminController@index')->name('admin');

        Route::get('/user', 'AdminController@indexUsers');
        Route::get('/user/api', function () {
            return $users=App\User::with(['profile'])->get();
        });

        Route::get('/member', function () {
            return view('layouts.admin.index-member');
        });
        Route::get('/member/{id}', 'UserController@index');

        Route::get('/add', function () {
            return view('layouts.admin.add-nomination');
        });

        Route::get('/nominations', function () {
            return view('layouts.admin.index-nomination');
        });

        Route::get('/judge/{id}', function () {
            return view('layouts.admin.show-judge');
        });
        Route::get('/judge', function () {
            return view('layouts.admin.index-judge');   
        });

        Route::get('/final', function () {
            return view('layouts.admin.index-final-list');   
        });

        Route::get('/winner', 'AdminController@winners');
        

        Route::get('/setting', function () {
            return view('layouts.admin.setting');   
        });
    });
//Members panel
Route::group(['prefix' => 'dashboard', 'middleware' => ['auth']], function(){
    Route::group(['middleware' => ['profile']], function(){
        Route::get('/', 'HomeController@index');
    
        Route::get('nominations', function() {
            $count = \App\Nomination::where('user_id','=',auth()->id())
            ->whereYear('created_at', date('Y'))
            ->get()
            ->count();

            $setting = \App\Setting::find(1);
            return view('layouts.member.nomination')->with('count',$count)->with('setting',$setting);
        });

        Route::get('history', function() {
            
            return view('layouts.member.history');
        });
    });

    Route::get('profile', function() {
        return view('layouts.member.updateprofile');
    });
});

//api routes
Route::group(['prefix' => 'api/v1', 'middleware' => ['auth']], function(){
    Route::group(['prefix' => 'setting'], function(){
        Route::post('/application_on', 'SettingController@ApplicationOn');
        Route::post('/application_off', 'SettingController@ApplicationOff');

        Route::post('/judge_on', 'SettingController@JudgeOn');
        Route::post('/judge_off', 'SettingController@JudgeOff');

        Route::post('/update', 'SettingController@Update');

        Route::get('/','SettingController@all');
    });


    Route::post('/score', 'ScoreController@store');
    Route::post('/updateEmptyScore', 'ScoreController@updateEmptyScore');
    
    Route::post('/finalScore', 'FinalScoreController@store');
 
    Route::post('/profile', 'ProfileController@store');
    Route::get('/profile', 'ProfileController@show');
    Route::post('/profile/{id}', 'ProfileController@update');

    Route::get('/nominations', 'NominationsController@show');
    Route::get('/history', 'NominationsController@history');
    Route::get('/nominations/{id}/edit', 'NominationsController@edit');
    Route::post('/nominations/{id}', 'NominationsController@update');
    Route::post('/nominations/{id}/judge', 'NominationsController@removeJudge');
    Route::post('/updatejudge', 'NominationsController@updateJudge');
    Route::delete('/nominations/{id}', 'NominationsController@destroy');
    Route::post('/nominations', 'NominationsController@store');
    Route::post('/admin-nominations', 'NominationsController@addByAdmin');

    Route::post('/messenge', 'MessengeController@store');
    Route::get('/messenge', 'MessengeController@show');

    Route::get('/member', function(){
        return $members=\App\User::with(['profile','roles'])->get();
    });
    Route::get('/member/nominations', 'NominationsController@index');
    Route::get('/member/{id}', function($id){
        $member = \App\User::with(['profile','roles','nominations'=>function($query){
            return $query->orderBy('created_at','desc');
        }])->find($id);

        
        return $member;
    });
    Route::post('/member/{id}', 'UserController@update');

    Route::post('/user/{id}', 'AdminController@update');
    Route::get('/user', function(){
         $members=\App\User::with(['profile','roles'])->get()->find(6);
        $users = \App\User::whereHas('roles', function ($query) {
            $query->where('name', 'admin');
        })->with(['profile','roles'])->get();
       
        return $users;
        
    });
    
    Route::get('/judge', function(){
        // $users = \App\User::whereHas('roles', function ($query) {
        //     $query->where('name', 'judge');
        // })->orderBy('created_at', 'desc')->get();
        $users = \App\Judge::has('nominations')
        ->with('nominations','profile','scores')
        ->orderBy('created_at', 'desc')->get();
        return $users;
    });
    Route::get('/judge/{id}', function($id){

            $judge = \App\Judge::with(['nominations','nominations.user', 'nominations.user.profile','profile','nominations.score'])
            ->find($id);
            

            return $judge;

    });

    Route::get('/judgepanel', function(){
        
        $judge = \App\Judge::with('nominations','nominations.score')
        ->find(auth()->id());
        return $judge;

    });
    
    // Get finalist

    Route::get('/final', 'WinnersController@finalList');
    Route::get('/finalListForJudge', 'WinnersController@finalListForJudge');

    // Get the final judges scores of the nominees in the final list

    Route::get('/finalScores', 'WinnersController@finalScores');

    // Get winners of each category

    Route::get('/winner', 'WinnersController@winner');

    Route::patch('/role/{id}', 'RoleController@update');
});

Route::group(['prefix' => 'nomination', 'middleware' => ['auth','admin']], function(){
    
    Route::get('/{id}', 'NominationsController@showforadmin');
    
});

// Route::get('/mailable', function () {
//     $nomination = \App\Nomination::find(1);

//     return new App\Mail\NewNominations($nomination);
// });


// Route::get('send', function(){
// 	Mail::raw('Sending emails with Mailgun and Laravel is easy!', function($message)
// 	{
// 		$message->subject('Mailgun and Laravel are awesome!');
// 		$message->from('no-reply@bas.hanyc.org', 'HANYC');
// 		$message->to(['alan@hanyc.org','hanycalan@gmail.com']);
// 	});
// });

Route::get('/judge',function () {
    
    return view('layouts.judge.index');
    
})->middleware('judge');




Route::group(['middleware' => ['auth','final_judge']], function () {
    
    Route::get('/final', function (){
    
        
        return view('layouts.judge.final');
    
    });

});

Route::post('/update', 'ScoreController@updateAll');




Route::get('/year', function(){
    $judge = \App\Judge::find(83);
    $judge->RemoveNominations();


});

