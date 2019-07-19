<?php

namespace App\Http\Controllers;

use App\Score;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'q1' => 'nullable|numeric|min:0|max:10',
            'q2' => 'nullable|numeric|min:0|max:10',
            'q3' => 'nullable|numeric|min:0|max:10',
            'q4' => 'nullable|numeric|min:0|max:10',
            'q5' => 'nullable|numeric|min:0|max:10',
            'publish_at' => 'nullable|date',
        ]);

        $nomination = \App\Nomination:: find($request->id);
        
        $nomination->updateScore(
            new Score(request(['q1','q2','q3','q4','q5']))
        );
        
 
    }

    public function updateEmptyScore(Request $request)
    {
        $nomination = \App\Nomination:: find($request->nomination_id);
        
        $nomination->updateEmptyScore(
            new Score(request(['q1','q2','q3','q4','q5']))
        );
        return $nomination->score;
    }

    public function show($id)
    {
        //  return $score = Score::find($id);
        // dd($score);
        return $score = Score::where('nomination_id','=',$id)->get();
    }

    public function updateAll()
    {
        $nominations = \App\Nomination::with('score')->get();
        
        // return $nominations;
        
        
        foreach($nominations as $key=>$value){
            // print "$key => $value\n";
            for($i=1 ; $i < 6 ; $i++) {
                if ($value["q" . $i] == null || $value["q" . $i] == '' ) {
                    // print ($value['score']);
                    // $value['score']["q" . $i] = '0';
                    $value->score()->update(["q" . $i => 0]);
                }
            }
          }


    }


}
