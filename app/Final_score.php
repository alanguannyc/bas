<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Final_score extends Model
{
    protected $guarded = [];
    
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function nomination(){
        return $this->belongsTo('App\Nomination');
    }
}
