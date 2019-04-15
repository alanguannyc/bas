<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Final_judge extends Model
{
    protected $table = 'users';

    public function nominations() {
        return $this->belongsToMany('App\Nomination');
    }

    public function final_scores(){
        return $this->hasMany('App\Final_score');
    }

    public function role() {
        return $this->hasOne('App\Role');
    }

    public function profile()
    {
        return $this->hasOne('App\Profile', 'user_id');
    }
}
