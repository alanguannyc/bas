<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nomination extends Model
{
    protected $fillable = ['category','title','name', 'q1', 'q2', 'q3', 'q4', 'q5'];

    public function user() {
       return $this->belongsTo('App\User');
    }

    public function judge() {
        return $this->belongsTo('App\Judge');
    }

    public function final_judges() {
        return $this->belongsToMany('App\Final_judge');
    }

    public function score()
    {
        return $this->hasOne('App\Score');
    }

    

    public function final_scores(){
        return $this->hasMany('App\Final_score');
    }

    public function updateScore($score) {
        
        $this->score()->updateOrCreate(['nomination_id'=>$this->id, 'judge_id'=>auth()->id()],['q1'=>$score->q1, 'q2'=>$score->q2, 'q3'=>$score->q3,'q4'=>$score->q4,'q5'=>$score->q5]);

    }

    //Update entire score to exclude empty response
    public function updateEmptyScore($score) {
        
        $this->score()->updateOrCreate(['nomination_id'=>$this->id],['q1'=>$score->q1, 'q2'=>$score->q2, 'q3'=>$score->q3,'q4'=>$score->q4,'q5'=>$score->q5]);

    }

    public function updateFinalScore($final_score) {
        // $this->score()->save($score);
        // foreach($score as $key=>$val) {
        //     array_push($results, $obj);
        // }
        $this->final_scores()->updateOrCreate(['user_id'=>auth()->id(), 'final_judge_id'=>auth()->id()],['nomination_id'=>$this->id,'q1'=>$final_score->q1, 'q2'=>$final_score->q2, 'q3'=>$final_score->q3,'q4'=>$final_score->q4,'q5'=>$final_score->q5]);

    }
}
