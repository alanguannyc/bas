<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $guarded = [];
    
    public function nomination()
    {
        return $this->belongsTo('App\Nomination');
    }
}
