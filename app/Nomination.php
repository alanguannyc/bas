<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nomination extends Model
{
    protected $fillable = ['category','title','name', 'q1', 'q2', 'q3', 'q4', 'q5'];

    public function user() {
       return $this->belongsTo('App\User');
    }
}
