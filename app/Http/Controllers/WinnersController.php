<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\Nomination;

class WinnersController extends Controller
{
    protected $categories = ['Full-Time Hourly With Guest Contact', 'Full-Time Room Attendant', 'Full-Time Hourly Without Guest Contact', 'Managerial Below General Manager'];

    private function getTotalCount($category)
    {
        return Nomination::with('score')
        ->where('category', $category)
        ->count();
    }

    private function getTopTenthScore($category)
    {
        $nomiatnions = Nomination::with('score')
        ->where('category', $category)
        ->get();

        $sorted = $nomiatnions->sortByDesc(function ($nomination, $key) {
            return $nomination['score']['q1'] + $nomination['score']['q2'] + $nomination['score']['q3'] + $nomination['score']['q4'] + $nomination['score']['q5'];
        });
        // if ($this->getTotalCount($category) > 9) {
        //     $nomination = $sorted->values()->get(10);
        // } elseif ($this->getTotalCount($category) < 10){
        //     $nomination = $sorted->last();
        // }
        
        $nomination =  $this->getTotalCount($category) > 9 ? $sorted->values()->get(10) : $sorted->last();

        $score = \App\Score::where('nomination_id', $nomination->id)->first() ? \App\Score::where('nomination_id', $nomination->id)->first()->total() : 0;

        return $score;
    }

    private function sumScores($score)
    {
        $sum = 0;
        for($i = 1; $i<6; $i++){
           $sum = $sum + $score['q' . $i]; 
        }
        return $sum;
    }

    private function addTotalScore($nominations)
    {
        foreach($nominations as $nomination)
        {
            $nomination['totalScore'] = $this->sumScores($nomination['score']);
        }
        return $nominations;
    }

    private function getFinalList($category, Bool $forJudge)
    {
        if($forJudge){
            $nomiatnions = Nomination::with(['score','user.profile','final_scores.final_judge','final_scores'=>function($query){
                $query->where('final_judge_id',auth()->id());
            }])
            ->where('category', $category)
            ->get();
        } else {
            $nomiatnions = Nomination::with(['score','user.profile','final_scores','final_scores.final_judge'])
            ->where('category', $category)
            ->get();
        }
        

        $filtered = $nomiatnions->filter(function ($value) use ($category) {
            return $this->sumScores($value['score']) >= $this->getTopTenthScore($category);
            // return $value['score']['q1'] + $value['score']['q2'] + $value['score']['q3'] + $value['score']['q4']+ $value['score']['q5'] >= $this->getTopTenthScore($value['category']);
        });

        $filtered->all();

        return $filtered;
    }

    public function finalListForJudge()
    {
        $FinalLists = collect();

        foreach($this->categories as $category) {
            $FinalLists = $FinalLists->concat($this->getFinalList($category, true));
        }

        $this->addTotalScore($FinalLists);

        return $FinalLists;
    }

    public function finalList()
    {
        $FinalLists = collect();

        foreach($this->categories as $category) {
            $FinalLists = $FinalLists->concat($this->getFinalList($category, false));
        }
        // $FinalLists = DB::table('nominations')
        //         ->when(true, function ($query, $judge) {
        //             return $query->whereHas('score');
        //         }, function ($query) {
        //             return $query->whereHas('final_scores');
        //         })
        //         ->get();
        $this->addTotalScore($FinalLists);

        return $FinalLists;   
    }

    private function getTopScore($category)
    {
        $WinnerList = $this->finalScores()
        ->where('category', $category)
        ;

        $score =  $WinnerList -> max('total_final_score');

        return $score;
    }

    private function getWinner($category)
    {
        $WinnerList = $this->finalScores()
        ->where('category', $category)
        ;

        $filtered = $WinnerList->filter(function ($value) use ($category){
            return $value['total_final_score'] >= $this->getTopScore($category);
            // return $value['score']['q1'] + $value['score']['q2'] + $value['score']['q3'] + $value['score']['q4']+ $value['score']['q5'] >= $this->getTopTenthScore($value['category']);
        });

        return $filtered;


    }

    public function winner() 
    {
        $WinnerList = $this->finalScores();

        
        $FinalLists = collect();

        foreach($this->categories as $category) {
            $FinalLists = $FinalLists->concat($this->getWinner($category));
        }

        return $FinalLists;
    }


    public function finalScores()
    {
        //Get all the finallist with Final Scores
        $FinalLists = $this->finalList();

        //Sum up final scores of each judge

        foreach($FinalLists as $nomination){
            foreach($nomination['final_scores'] as $finalScore){
                $finalScore['final_judge_name'] = $finalScore['final_judge']['name'];
                $finalScore['total'] = $this->sumScores($finalScore);
            }

        }

        //Write a new collection with total final scores and judge name
        foreach($FinalLists as $nomination){
            $total_final_score = 0;
            foreach($nomination['final_scores'] as $finalScore){
                $total_final_score = $total_final_score + $finalScore['total'];
            }
            $nomination['total_final_score'] = $total_final_score;
        }

        return $FinalLists;

       
    }
}
