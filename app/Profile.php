<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];
    
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function judge()
    {
        return $this->belongsTo('App\Judge','user_id');
    }
}
