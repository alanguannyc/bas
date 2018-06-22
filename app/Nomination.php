<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nomination extends Model
{
    protected $fillable = ['category','title','name', 'q1', 'q2', 'q3', 'q4', 'q5'];

    public function user() {
       return $this->belongsTo('App\User');
    }

    public function score()
    {
        return $this->hasOne('App\Score');
    }

    public function updateScore($score) {
        // $this->score()->save($score);
        // foreach($score as $key=>$val) {
        //     array_push($results, $obj);
        // }
        $this->score()->updateOrCreate(['nomination_id'=>$this->id],['q1'=>$score->q1, 'q2'=>$score->q2, 'q3'=>$score->q3,'q4'=>$score->q4,'q5'=>$score->q5]);

    }
}
