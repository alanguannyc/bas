<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Judge extends Model
{
    // protected $fillable = [
    //     'name', 'email', 'password',
    // ];

    // /**
    //  * The attributes that should be hidden for arrays.
    //  *
    //  * @var array
    //  */
    // protected $hidden = [
    //     'password', 'remember_token',
    // ];

    protected $table = 'users';

    public function nominations() {
        return $this->hasMany('App\Nomination');
    }

    public function scores() {
        return $this->hasMany('App\Score');
    }

    public function role() {
        return $this->hasOne('App\Role');
    }

    public function profile()
    {
        return $this->hasOne('App\Profile', 'user_id');
    }

    public function AssignNominations() {
        //Find all nominations without Judges
        $nominations = \App\Nomination::doesntHave('judge')->whereYear('created_at',date('Y'))->get();
        //Assign 10
        $total_unassigned_nominations = $nominations->count();
        $nominations_to_be_assigned = [];
        for ($i = 0;$i <= 10; $i ++)
        {
            $random_number = rand(0, $total_unassigned_nominations);
            array_push($nominations_to_be_assigned, $nominations[$random_number]);

        }
        
        $this->nominations()->saveMany($nominations_to_be_assigned);

    }
}
