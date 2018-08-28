<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;

class WinnersController extends Controller
{
    public function finalList()
    {
        $countOfWith= DB::table('nominations')
        ->where('category', '=', 'Full-Time Hourly With Guest Contact')
        ->join('scores', 'nominations.id', '=', 'scores.nomination_id')
        ->count();
        if($countOfWith > 9 ){
            $the10thnumber_1 = DB::table('nominations')
            ->where('category', '=', 'Full-Time Hourly With Guest Contact')
            ->join('scores', 'nominations.id', '=', 'scores.nomination_id')
            ->select(DB::raw('COALESCE(scores.q1, 0) + COALESCE(scores.q2,0) + COALESCE(scores.q3,0) + COALESCE(scores.q4,0) + COALESCE(scores.q5,0) as totalscore'))
            ->orderBy('totalscore', 'desc')
            ->skip(9)
            ->limit(1)
            ->get();
        } else{
            $the10thnumber_1 = DB::table('nominations')
            ->where('category', '=', 'Full-Time Hourly With Guest Contact')
            ->join('scores', 'nominations.id', '=', 'scores.nomination_id')
            ->select(DB::raw('COALESCE(scores.q1, 0) + COALESCE(scores.q2,0) + COALESCE(scores.q3,0) + COALESCE(scores.q4,0) + COALESCE(scores.q5,0) as totalscore'))
            ->orderBy('totalscore', 'desc')
            ->skip($countOfWith-1)
            ->limit(1)
            ->get();

        }
        
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
        if($countOfRoom > 9){
            $the10thnumber_2 = DB::table('nominations')
            ->where('category', '=', 'Full-Time Room Attendant')
            ->join('scores', 'nominations.id', '=', 'scores.nomination_id')
            ->select(DB::raw('COALESCE(scores.q1, 0) + COALESCE(scores.q2,0) + COALESCE(scores.q3,0) + COALESCE(scores.q4,0) + COALESCE(scores.q5,0) as totalscore'))
            ->orderBy('totalscore', 'desc')
            ->skip(9)
            ->limit(1)
            ->get();
        } else{
            $the10thnumber_2 = DB::table('nominations')
            ->where('category', '=', 'Full-Time Room Attendant')
            ->join('scores', 'nominations.id', '=', 'scores.nomination_id')
            ->select(DB::raw('COALESCE(scores.q1, 0) + COALESCE(scores.q2,0) + COALESCE(scores.q3,0) + COALESCE(scores.q4,0) + COALESCE(scores.q5,0) as totalscore'))
            ->orderBy('totalscore', 'desc')
            ->skip($countOfRoom - 1)
            ->limit(1)
            ->get();
        }
        
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
        if($countOfWithout > 9 ){
            $the10thnumber_3 = DB::table('nominations')
            ->where('category', '=', 'Full-Time Hourly Without Guest Contact')
            ->join('scores', 'nominations.id', '=', 'scores.nomination_id')
            ->select(DB::raw('COALESCE(scores.q1, 0) + COALESCE(scores.q2,0) + COALESCE(scores.q3,0) + COALESCE(scores.q4,0) + COALESCE(scores.q5,0) as totalscore'))
            ->orderBy('totalscore', 'desc')
            ->skip(9)
            ->limit(1)
            ->get();
        } else {
            $the10thnumber_3 = DB::table('nominations')
            ->where('category', '=', 'Full-Time Hourly Without Guest Contact')
            ->join('scores', 'nominations.id', '=', 'scores.nomination_id')
            ->select(DB::raw('COALESCE(scores.q1, 0) + COALESCE(scores.q2,0) + COALESCE(scores.q3,0) + COALESCE(scores.q4,0) + COALESCE(scores.q5,0) as totalscore'))
            ->orderBy('totalscore', 'desc')
            ->skip($countOfWithout-1)
            ->limit(1)
            ->get();
        }
        
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
        if($countOfManagerial > 9){
            $the10thnumber_4 = DB::table('nominations')
            ->where('category', '=', 'Managerial Below General Manager')
            ->join('scores', 'nominations.id', '=', 'scores.nomination_id')
            ->select(DB::raw('COALESCE(scores.q1, 0) + COALESCE(scores.q2,0) + COALESCE(scores.q3,0) + COALESCE(scores.q4,0) + COALESCE(scores.q5,0) as totalscore'))
            ->orderBy('totalscore', 'desc')
            ->skip( 9 )
            ->limit(1)
            ->get();
        } else {
            $the10thnumber_4 = DB::table('nominations')
            ->where('category', '=', 'Managerial Below General Manager')
            ->join('scores', 'nominations.id', '=', 'scores.nomination_id')
            ->select(DB::raw('COALESCE(scores.q1, 0) + COALESCE(scores.q2,0) + COALESCE(scores.q3,0) + COALESCE(scores.q4,0) + COALESCE(scores.q5,0) as totalscore'))
            ->orderBy('totalscore', 'desc')
            ->skip( $countOfManagerial-1 )
            ->limit(1)
            ->get();
        }
        
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
    }

    public static function winner() 
    {
        $countOfWith= DB::table('nominations')
        ->where('category', '=', 'Full-Time Hourly With Guest Contact')
        ->join('final_scores', 'nominations.id', '=', 'final_scores.nomination_id')
        ->count();
        if ($countOfWith > 0) {
            $the10thnumber_1 = DB::table('nominations')
            ->where('category', '=', 'Full-Time Hourly With Guest Contact')
            ->join('final_scores', 'nominations.id', '=', 'final_scores.nomination_id')
            ->select(DB::raw('SUM(COALESCE(final_scores.q1, 0) + COALESCE(final_scores.q2,0) + COALESCE(final_scores.q3,0) + COALESCE(final_scores.q4,0) + COALESCE(final_scores.q5,0)) as total_final_score'))
            ->orderBy('total_final_score', 'desc')
            ->groupby('nominations.id')
            ->limit(1)
            ->get();

            $nominations_1 = DB::table('nominations')
            ->where('category', '=', 'Full-Time Hourly With Guest Contact')
            ->join('final_scores', 'nominations.id', '=', 'final_scores.nomination_id')
            ->join('profiles', 'nominations.user_id', '=', 'profiles.user_id')
            ->select('nominations.*',  DB::raw('ANY_VALUE(profiles.company) as hotel'),  DB::raw('SUM(COALESCE(final_scores.q1, 0) + COALESCE(final_scores.q2,0) + COALESCE(final_scores.q3,0) + COALESCE(final_scores.q4,0) + COALESCE(final_scores.q5,0)) as total_final_score'))
            ->groupby('nominations.id')
            ->havingRaw('total_final_score >= ?', [$the10thnumber_1[0]->total_final_score]);

        } else {
            
            $nominations_1 = DB::table('nominations')
            ->where('category', '=', 'Full-Time Hourly With Guest Contact')
            ->join('final_scores', 'nominations.id', '=', 'final_scores.nomination_id')
            ->join('profiles', 'nominations.user_id', '=', 'profiles.user_id')
            ->select('nominations.*',  DB::raw('ANY_VALUE(profiles.company) as hotel'),  DB::raw('SUM(COALESCE(final_scores.q1, 0) + COALESCE(final_scores.q2,0) + COALESCE(final_scores.q3,0) + COALESCE(final_scores.q4,0) + COALESCE(final_scores.q5,0)) as total_final_score'))
            ->groupby('nominations.id');
            
        }
        
        

        
        
        $countOfRoom= DB::table('nominations')
        ->where('category', '=', 'Full-Time Room Attendant')
        ->join('final_scores', 'nominations.id', '=', 'final_scores.nomination_id')
        ->count();
        
        if($countOfRoom>0) {
            $the10thnumber_2 = DB::table('nominations')
            ->where('category', '=', 'Full-Time Room Attendant')
            ->join('final_scores', 'nominations.id', '=', 'final_scores.nomination_id')
            ->select(DB::raw('SUM(COALESCE(final_scores.q1, 0) + COALESCE(final_scores.q2,0) + COALESCE(final_scores.q3,0) + COALESCE(final_scores.q4,0) + COALESCE(final_scores.q5,0)) as total_final_score'))
            ->orderBy('total_final_score', 'desc')
            ->groupby('nominations.id')
            ->limit(1)
            ->get();
            $nominations_2 = DB::table('nominations')
            ->where('category', '=', 'Full-Time Room Attendant')
            ->join('final_scores', 'nominations.id', '=', 'final_scores.nomination_id')
            ->join('profiles', 'nominations.user_id', '=', 'profiles.user_id')
            ->select('nominations.*',  DB::raw('ANY_VALUE(profiles.company) as hotel'),  DB::raw('SUM(COALESCE(final_scores.q1, 0) + COALESCE(final_scores.q2,0) + COALESCE(final_scores.q3,0) + COALESCE(final_scores.q4,0) + COALESCE(final_scores.q5,0)) as total_final_score'))
            ->groupby('nominations.id')
            ->havingRaw('total_final_score >= ?', [$the10thnumber_2[0]->total_final_score]);
        } else {
            $nominations_2 = DB::table('nominations')
            ->where('category', '=', 'Full-Time Room Attendant')
            ->join('final_scores', 'nominations.id', '=', 'final_scores.nomination_id')
            ->join('profiles', 'nominations.user_id', '=', 'profiles.user_id')
            ->select('nominations.*',  DB::raw('ANY_VALUE(profiles.company) as hotel'),  DB::raw('SUM(COALESCE(final_scores.q1, 0) + COALESCE(final_scores.q2,0) + COALESCE(final_scores.q3,0) + COALESCE(final_scores.q4,0) + COALESCE(final_scores.q5,0)) as total_final_score'))
            ->groupby('nominations.id');
        }
        
        
        $countOfWithout= DB::table('nominations')
        ->where('category', '=', 'Full-Time Hourly Without Guest Contact')
        ->join('final_scores', 'nominations.id', '=', 'final_scores.nomination_id')
        ->count();
        if ($countOfWithout >0) {
            $the10thnumber_3 = DB::table('nominations')
            ->where('category', '=', 'Full-Time Hourly Without Guest Contact')
            ->join('final_scores', 'nominations.id', '=', 'final_scores.nomination_id')
            ->select(DB::raw('SUM(COALESCE(final_scores.q1, 0) + COALESCE(final_scores.q2,0) + COALESCE(final_scores.q3,0) + COALESCE(final_scores.q4,0) + COALESCE(final_scores.q5,0)) as total_final_score'))
            ->orderBy('total_final_score', 'desc')
            ->groupby('nominations.id')
            ->limit(1)
            ->get();
            $nominations_3 = DB::table('nominations')
            ->where('category', '=', 'Full-Time Hourly Without Guest Contact')
            ->join('final_scores', 'nominations.id', '=', 'final_scores.nomination_id')
            ->join('profiles', 'nominations.user_id', '=', 'profiles.user_id')
            ->select('nominations.*',  DB::raw('ANY_VALUE(profiles.company) as hotel'),  DB::raw('SUM(COALESCE(final_scores.q1, 0) + COALESCE(final_scores.q2,0) + COALESCE(final_scores.q3,0) + COALESCE(final_scores.q4,0) + COALESCE(final_scores.q5,0)) as total_final_score'))
            ->groupby('nominations.id')
            ->havingRaw('total_final_score >= ?', [$the10thnumber_3[0]->total_final_score]);
        } else {
            $nominations_3 = DB::table('nominations')
            ->where('category', '=', 'Full-Time Hourly Without Guest Contact')
            ->join('final_scores', 'nominations.id', '=', 'final_scores.nomination_id')
            ->join('profiles', 'nominations.user_id', '=', 'profiles.user_id')
            ->select('nominations.*',  DB::raw('ANY_VALUE(profiles.company) as hotel'),  DB::raw('SUM(COALESCE(final_scores.q1, 0) + COALESCE(final_scores.q2,0) + COALESCE(final_scores.q3,0) + COALESCE(final_scores.q4,0) + COALESCE(final_scores.q5,0)) as total_final_score'))
            ->groupby('nominations.id');
        }
        
        
        $countOfManager= DB::table('nominations')
        ->where('category', '=', 'Managerial Below General Manager')
        ->join('final_scores', 'nominations.id', '=', 'final_scores.nomination_id')
        ->count();
        if ($countOfManager > 0) {
            $the10thnumber_4 = DB::table('nominations')
            ->where('category', '=', 'Managerial Below General Manager')
            ->join('final_scores', 'nominations.id', '=', 'final_scores.nomination_id')
            ->select(DB::raw('SUM(COALESCE(final_scores.q1, 0) + COALESCE(final_scores.q2,0) + COALESCE(final_scores.q3,0) + COALESCE(final_scores.q4,0) + COALESCE(final_scores.q5,0)) as total_final_score'))
            ->orderBy('total_final_score', 'desc')
            ->groupby('nominations.id')
            ->limit(1)
            ->get();

            $nominations_4 = DB::table('nominations')
            ->where('category', '=', 'Managerial Below General Manager')
            ->join('final_scores', 'nominations.id', '=', 'final_scores.nomination_id')
            ->join('profiles', 'nominations.user_id', '=', 'profiles.user_id')
            ->select('nominations.*',  DB::raw('ANY_VALUE(profiles.company) as hotel'),  DB::raw('SUM(COALESCE(final_scores.q1, 0) + COALESCE(final_scores.q2,0) + COALESCE(final_scores.q3,0) + COALESCE(final_scores.q4,0) + COALESCE(final_scores.q5,0)) as total_final_score'))
            ->groupby('nominations.id')
            ->havingRaw('total_final_score >= ?', [$the10thnumber_4[0]->total_final_score])
            ->union($nominations_1)
            // ->union($nominations_2)
            // ->union($nominations_3)
            ->get();
        } else {
            $nominations_4 = DB::table('nominations')
        ->where('category', '=', 'Managerial Below General Manager')
        ->join('final_scores', 'nominations.id', '=', 'final_scores.nomination_id')
        ->join('profiles', 'nominations.user_id', '=', 'profiles.user_id')
        ->select('nominations.*',  DB::raw('ANY_VALUE(profiles.company) as hotel'),  DB::raw('SUM(COALESCE(final_scores.q1, 0) + COALESCE(final_scores.q2,0) + COALESCE(final_scores.q3,0) + COALESCE(final_scores.q4,0) + COALESCE(final_scores.q5,0)) as total_final_score'))
        ->groupby('nominations.id')
        ->union($nominations_1)
        // ->union($nominations_2)
        // ->union($nominations_3)
        ->get();
        }
        
        

        return $nominations_4;
    }

    public function finalScores()
    {
        $nominations = DB::table('nominations')
        ->leftJoin('final_scores as judge_1', function($query) {
            $query->on('nominations.id', '=', 'judge_1.nomination_id')
            ->where('judge_1.user_id','=',216);
        })
        ->leftJoin('final_scores as judge_2', function($query) {
            $query->on('nominations.id', '=', 'judge_2.nomination_id')
            ->where('judge_2.user_id','=',217);
        })
        ->leftJoin('final_scores as judge_3', function($query) {
            $query->on('nominations.id', '=', 'judge_3.nomination_id')
            ->where('judge_3.user_id','=',218);
        })
        ->leftJoin('final_scores as judge_4', function($query) {
            $query->on('nominations.id', '=', 'judge_4.nomination_id')
            ->where('judge_4.user_id','=',219);
        })
        
        

        ->join('profiles', 'nominations.user_id', '=', 'profiles.user_id')
        ->select('nominations.*', DB::raw('ANY_VALUE(profiles.company) as hotel'), 
        DB::raw('(COALESCE(judge_1.q1, 0) + COALESCE(judge_1.q2,0) + COALESCE(judge_1.q3,0) + COALESCE(judge_1.q4,0) + COALESCE(judge_1.q5,0)) as total_final_score_1'),
        DB::raw('(COALESCE(judge_2.q1, 0) + COALESCE(judge_2.q2,0) + COALESCE(judge_2.q3,0) + COALESCE(judge_2.q4,0) + COALESCE(judge_2.q5,0)) as total_final_score_2'),
        DB::raw('(COALESCE(judge_3.q1, 0) + COALESCE(judge_3.q2,0) + COALESCE(judge_3.q3,0) + COALESCE(judge_3.q4,0) + COALESCE(judge_3.q5,0)) as total_final_score_3'),
        DB::raw('(COALESCE(judge_4.q1, 0) + COALESCE(judge_4.q2,0) + COALESCE(judge_4.q3,0) + COALESCE(judge_4.q4,0) + COALESCE(judge_4.q5,0)) as total_final_score_4'))

        
        ->orderBy('id')
        ->get();

        return $nominations;
    }
}
