<?php


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/logout' , 'Auth\LoginController@logout');

Route::group(['prefix' => 'admin',  'middleware' => ['auth','admin']], function()
    {
        Route::get('/', function() {
            return view('layouts.admin.index');
        })->name('admin');

        Route::get('/user', 'AdminController@indexUsers');
        Route::get('/user/api', function () {
            return $users=App\User::with(['profile'])->get();
        });

        Route::get('/member', function () {
            return view('layouts.admin.index-member');
        });
        Route::get('/member/{id}', 'UserController@index');

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
        
    });
    
Route::group(['prefix' => 'dashboard', 'middleware' => ['auth','judge']], function(){
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
    Route::post('/score', 'ScoreController@store');
    
    Route::post('/finalScore', 'FinalScoreController@store');
 
    Route::post('/profile', 'ProfileController@store');
    Route::get('/profile', 'ProfileController@show');
    Route::post('/profile/{id}', 'ProfileController@update');

    Route::get('/nominations', 'NominationsController@show');
    Route::get('/nominations/{id}/edit', 'NominationsController@edit');
    Route::post('/nominations/{id}', 'NominationsController@update');
    Route::delete('/nominations/{id}', 'NominationsController@destroy');
    Route::post('/nominations', 'NominationsController@store');

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
        // $users = \App\User::whereHas('roles', function ($query) {
        //     $query->where('name', 'judge');
        // })->with(['profile','roles'])->get();
        $users = \App\User::whereHas('roles', function ($query) {
            $query->where('name', 'judge');
        })->orderBy('created_at', 'desc')->get();
        return $users;
    });
    Route::get('/judge/{id}', function($id){
        
            if ($id == 0) {
                $nominations = DB::table('nominations')
                ->whereBetween('id', array(0, $id*10+9))->get();
                return $nominations;
            } else if ($id >= 1) {
                $nominations = DB::table('nominations')
                ->whereBetween('id', array($id*10, $id*10+10))->get();
                return $nominations;
            }

    });

    Route::get('/final', function(){
        
        $countOfWith= DB::table('nominations')
        ->where('category', '=', 'Full-Time Hourly With Guest Contact')
        ->join('scores', 'nominations.id', '=', 'scores.nomination_id')
        ->count();
        $the10thnumber_1 = DB::table('nominations')
        ->where('category', '=', 'Full-Time Hourly With Guest Contact')
        ->join('scores', 'nominations.id', '=', 'scores.nomination_id')
        ->select(DB::raw('COALESCE(scores.q1, 0) + COALESCE(scores.q2,0) + COALESCE(scores.q3,0) + COALESCE(scores.q4,0) + COALESCE(scores.q5,0) as totalscore'))
        ->orderBy('totalscore', 'desc')
        ->skip($countOfWith - 1)
        ->limit(1)
        ->get();
        $nominations_1 = DB::table('nominations')
        ->where('category', '=', 'Full-Time Hourly With Guest Contact')
        ->join('scores', 'nominations.id', '=', 'scores.nomination_id')
        ->join('profiles', 'nominations.user_id', '=', 'profiles.user_id')
        ->select('nominations.*', 'profiles.company', DB::raw('scores.id as score_id, COALESCE(scores.q1, 0) + COALESCE(scores.q2,0) + COALESCE(scores.q3,0) + COALESCE(scores.q4,0) + COALESCE(scores.q5,0) as totalscore'))
        ->orderBy('totalscore', 'desc')
        ->havingRaw('totalscore >= ?', [$the10thnumber_1[0]->totalscore]);
        
        $countOfRoom= DB::table('nominations')
        ->where('category', '=', 'Full-Time Room Attendant')
        ->join('scores', 'nominations.id', '=', 'scores.nomination_id')
        ->count();
        $the10thnumber_2 = DB::table('nominations')
        ->where('category', '=', 'Full-Time Room Attendant')
        ->join('scores', 'nominations.id', '=', 'scores.nomination_id')
        ->select(DB::raw('COALESCE(scores.q1, 0) + COALESCE(scores.q2,0) + COALESCE(scores.q3,0) + COALESCE(scores.q4,0) + COALESCE(scores.q5,0) as totalscore'))
        ->orderBy('totalscore', 'desc')
        ->skip($countOfRoom - 1)
        ->limit(1)
        ->get();
        $nominations_2 = DB::table('nominations')
        ->where('category', '=', 'Full-Time Room Attendant')
        ->join('scores', 'nominations.id', '=', 'scores.nomination_id')
        ->join('profiles', 'nominations.user_id', '=', 'profiles.user_id')
        ->select('nominations.*','profiles.company', DB::raw('scores.id as score_id, COALESCE(scores.q1, 0) + COALESCE(scores.q2,0) + COALESCE(scores.q3,0) + COALESCE(scores.q4,0) + COALESCE(scores.q5,0) as totalscore'))
        ->havingRaw('totalscore >= ?', [$the10thnumber_2[0]->totalscore]);
        
        
        $countOfWithout = DB::table('nominations')
        ->where('category', '=', 'Full-Time Hourly Without Guest Contact')
        ->join('scores', 'nominations.id', '=', 'scores.nomination_id')
        ->count();
        $the10thnumber_3 = DB::table('nominations')
        ->where('category', '=', 'Full-Time Hourly Without Guest Contact')
        ->join('scores', 'nominations.id', '=', 'scores.nomination_id')
        ->select(DB::raw('COALESCE(scores.q1, 0) + COALESCE(scores.q2,0) + COALESCE(scores.q3,0) + COALESCE(scores.q4,0) + COALESCE(scores.q5,0) as totalscore'))
        ->orderBy('totalscore', 'desc')
        ->skip($countOfWithout - 1)
        ->limit(1)
        ->get();
        $nominations_3 = DB::table('nominations')
        ->where('category', '=', 'Full-Time Hourly Without Guest Contact')
        ->join('scores', 'nominations.id', '=', 'scores.nomination_id')
        ->join('profiles', 'nominations.user_id', '=', 'profiles.user_id')
        ->select('nominations.*', 'profiles.company', DB::raw('scores.id as score_id, COALESCE(scores.q1, 0) + COALESCE(scores.q2,0) + COALESCE(scores.q3,0) + COALESCE(scores.q4,0) + COALESCE(scores.q5,0) as totalscore'))
        ->orderBy('totalscore', 'desc')
        ->havingRaw('totalscore >= ?', [$the10thnumber_3[0]->totalscore]);
        
 
        $countOfManagerial = DB::table('nominations')
        ->where('category', '=', 'Managerial Below General Manager') 
        ->join('scores', 'nominations.id', '=', 'scores.nomination_id')
        ->count() ;
        $the10thnumber_4 = DB::table('nominations')
        ->where('category', '=', 'Managerial Below General Manager')
        ->join('scores', 'nominations.id', '=', 'scores.nomination_id')
        ->select(DB::raw('COALESCE(scores.q1, 0) + COALESCE(scores.q2,0) + COALESCE(scores.q3,0) + COALESCE(scores.q4,0) + COALESCE(scores.q5,0) as totalscore'))
        ->orderBy('totalscore', 'desc')
        ->skip( $countOfManagerial - 1 )
        ->limit(1)
        ->get();
        $nominations_4 = DB::table('nominations')
        ->where('category', '=', 'Managerial Below General Manager')
        ->join('scores', 'nominations.id', '=', 'scores.nomination_id')
        ->leftJoin('profiles', 'nominations.user_id', '=', 'profiles.user_id')
        ->select('nominations.*', 'profiles.company',  DB::raw('scores.id as score_id, COALESCE(scores.q1, 0) + COALESCE(scores.q2,0) + COALESCE(scores.q3,0) + COALESCE(scores.q4,0) + COALESCE(scores.q5,0) as totalscore'))
        ->orderBy('totalscore', 'desc')
        ->havingRaw('totalscore >= ?', [$the10thnumber_4[0]->totalscore])
        ->union($nominations_1)
        ->union($nominations_2)
        ->union($nominations_3)
        ->get();

        return $nominations_4;
        
    });

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
    // $users = \App\User::whereHas('roles', function ($query) {
    //         $query->where('name', 'judge');
    //     })->orderBy('created_at', 'desc')->get();
    //     foreach ($users as $key => $value) {
    //         echo $value['id'] . '<br>';
    //      }
    
    return view('layouts.judge.index');
    
})->middleware('judge');


Route::get('/final', function (){
    
    return view('layouts.judge.final');
});