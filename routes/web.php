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
            return view('layouts.member.nomination')->with('count',$count);
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
        
        $data['nomination']=\App\Nomination::where('user_id','=', $id)->get();
        $data['member']=\App\User::with(['profile','roles'])->get()->find($id);
        
        return $data;
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
        $users = \App\User::whereHas('roles', function ($query) {
            $query->where('name', 'judge');
        })->orderBy('created_at', 'desc')->get();
        return $users;
    });
    Route::get('/judge/{id}', function($id){
        
            if ($id == 0) {
                $nominations = DB::table('nominations')
                ->whereBetween('nominations.id', array(0, 10))
                ->join('profiles', 'nominations.user_id', '=', 'profiles.user_id')
                ->select('nominations.*', 'profiles.company', 'profiles.id as profile_id')
                ->get();
                return $nominations;
            } else if ($id >= 1) {
                $nominations = DB::table('nominations')
                ->whereBetween('nominations.id', array($id*10+1, $id*10+10))
                ->whereNotIn('nominations.id', [19])
                ->join('profiles', 'nominations.user_id', '=', 'profiles.user_id')
                ->select('nominations.*', 'profiles.company', 'profiles.id as profile_id')
                ->get();
                return $nominations;
            }

    });
    
    // Get finalist

    Route::get('/final', 'WinnersController@finalList');

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

Route::get('/judge/{id}',function () {
    
    return view('layouts.judge.index');
    
})->middleware('judge');




Route::group(['middleware' => ['auth','final_judge']], function () {
    
    Route::get('/final', function (){
    
        
        return view('layouts.judge.final');
    
    });

});

Route::post('/update', 'ScoreController@updateAll');





Route::get('/year', function(){


    $nominations = \App\Nomination::select('*')
    ->where('user_id','=',6)
    ->orderBy('created_at','DESC')
    ->get()
    // ->unique('user_id')

    // ->select(DB::raw('*, created_at as createdAt'))

    // ->orderBy('createdAt', 'desc')
    
    // ->latest('created_at')
    // ->get()
    // ->groupBy('user_id')
    // ;
    ->groupBy(function($date) {
        return Carbon::parse($date->created_at)->format('Y'); // grouping by years
        //return Carbon::parse($date->created_at)->format('m'); // grouping by months
    })
    ->toArray()
    ;

    // $nominations = \App\Nomination::all()
    // ->orderBy('created_at','DESC')
    // ->groupBy('user_id')
    // ->latest('createdAt')
    // ->first();
    // ->where('user_id','=',6)
    
    // $userNominations = DB::table(DB::raw("({$nominations->toSql()}) as sub"))
    
    // $nominations = $nominations
    // ->groupBy('user_id');


    // $nominations=$nominations->sort();

   

    return $nominations;
});

