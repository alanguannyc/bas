<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Final_score extends Model
{
    protected $guarded = [];
    
    public function final_judge(){
        return $this->belongsTo('App\Final_judge','user_id');
    }


    public function nomination(){
        return $this->belongsTo('App\Nomination');
    }
}
