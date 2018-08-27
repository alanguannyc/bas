<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AdminController extends WinnersController
{
    public function indexUsers()
    {     
        $users = User::all();
        return view('layouts.admin.user');

    }

    public function index() 
    {
        //     $countOfWith= DB::table('nominations')
        //     ->where('category', '=', 'Full-Time Hourly With Guest Contact')
        //     ->join('final_scores', 'nominations.id', '=', 'final_scores.nomination_id')
        //     ->count();
        //     $the10thnumber_1 = DB::table('nominations')
        //     ->where('category', '=', 'Full-Time Hourly With Guest Contact')
        //     ->join('final_scores', 'nominations.id', '=', 'final_scores.nomination_id')
        //     ->select(DB::raw('SUM(COALESCE(final_scores.q1, 0) + COALESCE(final_scores.q2,0) + COALESCE(final_scores.q3,0) + COALESCE(final_scores.q4,0) + COALESCE(final_scores.q5,0)) as total_final_score'))
        //     ->orderBy('total_final_score', 'desc')
        //     ->groupby('nominations.id')
        //     ->limit(1)
        //     ->get();
        //     $nominations_1 = DB::table('nominations')
        //     ->where('category', '=', 'Full-Time Hourly With Guest Contact')
        //     ->join('final_scores', 'nominations.id', '=', 'final_scores.nomination_id')
        //     ->join('profiles', 'nominations.user_id', '=', 'profiles.user_id')
        //     ->select('nominations.*',  DB::raw('ANY_VALUE(profiles.company) as hotel'),  DB::raw('SUM(COALESCE(final_scores.q1, 0) + COALESCE(final_scores.q2,0) + COALESCE(final_scores.q3,0) + COALESCE(final_scores.q4,0) + COALESCE(final_scores.q5,0)) as total_final_score'))
        //     ->groupby('nominations.id')
        //     ->havingRaw('total_final_score >= ?', [$the10thnumber_1[0]->total_final_score]);
        

        // $countOfRoom= DB::table('nominations')
        // ->where('category', '=', 'Managerial Below General Manager')
        // ->join('final_scores', 'nominations.id', '=', 'final_scores.nomination_id')
        // ->count();
        // $the10thnumber_2 = DB::table('nominations')
        // ->where('category', '=', 'Full-Time Room Attendant')
        // ->join('final_scores', 'nominations.id', '=', 'final_scores.nomination_id')
        // ->select(DB::raw('SUM(COALESCE(final_scores.q1, 0) + COALESCE(final_scores.q2,0) + COALESCE(final_scores.q3,0) + COALESCE(final_scores.q4,0) + COALESCE(final_scores.q5,0)) as total_final_score'))
        // ->orderBy('total_final_score', 'desc')
        // ->groupby('nominations.id')
        // ->limit(1)
        // ->get();
        // $nominations_2 = DB::table('nominations')
        // ->where('category', '=', 'Full-Time Room Attendant')
        // ->join('final_scores', 'nominations.id', '=', 'final_scores.nomination_id')
        // ->join('profiles', 'nominations.user_id', '=', 'profiles.user_id')
        // ->select('nominations.*',  DB::raw('ANY_VALUE(profiles.company) as hotel'),  DB::raw('SUM(COALESCE(final_scores.q1, 0) + COALESCE(final_scores.q2,0) + COALESCE(final_scores.q3,0) + COALESCE(final_scores.q4,0) + COALESCE(final_scores.q5,0)) as total_final_score'))
        // ->groupby('nominations.id')
        // ->havingRaw('total_final_score >= ?', [$the10thnumber_2[0]->total_final_score]);
        

        // $the10thnumber_3 = DB::table('nominations')
        // ->where('category', '=', 'Full-Time Hourly Without Guest Contact')
        // ->join('final_scores', 'nominations.id', '=', 'final_scores.nomination_id')
        // ->select(DB::raw('SUM(COALESCE(final_scores.q1, 0) + COALESCE(final_scores.q2,0) + COALESCE(final_scores.q3,0) + COALESCE(final_scores.q4,0) + COALESCE(final_scores.q5,0)) as total_final_score'))
        // ->orderBy('total_final_score', 'desc')
        // ->groupby('nominations.id')
        // ->limit(1)
        // ->get();
        // $nominations_3 = DB::table('nominations')
        // ->where('category', '=', 'Full-Time Hourly Without Guest Contact')
        // ->join('final_scores', 'nominations.id', '=', 'final_scores.nomination_id')
        // ->join('profiles', 'nominations.user_id', '=', 'profiles.user_id')
        // ->select('nominations.*',  DB::raw('ANY_VALUE(profiles.company) as hotel'),  DB::raw('SUM(COALESCE(final_scores.q1, 0) + COALESCE(final_scores.q2,0) + COALESCE(final_scores.q3,0) + COALESCE(final_scores.q4,0) + COALESCE(final_scores.q5,0)) as total_final_score'))
        // ->groupby('nominations.id')
        // ->havingRaw('total_final_score >= ?', [$the10thnumber_3[0]->total_final_score]);
        

        // $the10thnumber_4 = DB::table('nominations')
        // ->where('category', '=', 'Managerial Below General Manager')
        // ->join('final_scores', 'nominations.id', '=', 'final_scores.nomination_id')
        // ->select(DB::raw('SUM(COALESCE(final_scores.q1, 0) + COALESCE(final_scores.q2,0) + COALESCE(final_scores.q3,0) + COALESCE(final_scores.q4,0) + COALESCE(final_scores.q5,0)) as total_final_score'))
        // ->orderBy('total_final_score', 'desc')
        // ->groupby('nominations.id')
        // ->limit(1)
        // ->get();
        // $nominations_4 = DB::table('nominations')
        // ->where('category', '=', 'Managerial Below General Manager')
        // ->join('final_scores', 'nominations.id', '=', 'final_scores.nomination_id')
        // ->join('profiles', 'nominations.user_id', '=', 'profiles.user_id')
        // ->select('nominations.*',  DB::raw('ANY_VALUE(profiles.company) as hotel'),  DB::raw('SUM(COALESCE(final_scores.q1, 0) + COALESCE(final_scores.q2,0) + COALESCE(final_scores.q3,0) + COALESCE(final_scores.q4,0) + COALESCE(final_scores.q5,0)) as total_final_score'))
        // ->groupby('nominations.id')
        // ->havingRaw('total_final_score >= ?', [$the10thnumber_4[0]->total_final_score])
        // ->union($nominations_1)
        // ->union($nominations_2)
        // ->union($nominations_3)
        // ->get();

        
            // return view('layouts.admin.index')->with('winners', $nominations_4);
            return view('layouts.admin.index')->with('winners');
    }

    public function winners()
    {
        $winners = WinnersController::winner();

        return view('layouts.admin.index-winner-list')->with('winners', $winners);
    }
}
