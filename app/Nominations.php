<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nominations extends Model
{
    protected $fillable = ['name', 'q1', 'q2', 'q3', 'q4', 'q5'];
}
