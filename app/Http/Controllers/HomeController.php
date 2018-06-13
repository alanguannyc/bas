<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Profile;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile = Profile::where('user_id','=',auth()->id())->get();
        $msg = \App\Messenge::latest()->first();
        return view('layouts.member.index')->with('profile',$profile[0])->with('messenge', $msg);
    }
}
