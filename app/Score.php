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

    public function judge()
    {
        return $this->belongsTo('App\Judge');
    }

    public function total()
    {
        return $this->q1 + $this->q2 + $this->q3 + $this->q4 +$this->q5;
    }
}
