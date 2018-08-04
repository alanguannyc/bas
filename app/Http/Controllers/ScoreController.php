<?php

namespace App\Http\Controllers;

use App\Score;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'q1' => 'nullable|numeric|min:0|max:5',
            'q2' => 'nullable|numeric|min:0|max:5',
            'q3' => 'nullable|numeric|min:0|max:5',
            'q4' => 'nullable|numeric|min:0|max:5',
            'q5' => 'nullable|numeric|min:0|max:5',
            'publish_at' => 'nullable|date',
        ]);

        $nomination = \App\Nomination:: find($request->id);
        
        $nomination->updateScore(
            new Score(request(['q1','q2','q3','q4','q5']))
        );
        

    }

    public function show($id)
    {
        //  return $score = Score::find($id);
        // dd($score);
        return $score = Score::where('nomination_id','=',$id)->get();
    }
}
