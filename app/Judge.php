<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Judge extends Model
{

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

    public function AssignNominations() 
    {
        //Find all nominations without Judges
        $nominations = \App\Nomination::doesntHave('judge')->whereYear('created_at',date('Y'))->orderBy('category','desc')->get();
        //Assign 10
        $total_unassigned_nominations = $nominations->count();
        $nominations_to_be_assigned = [];
        for ($i = 0;$i < ($total_unassigned_nominations >5 ? 6 : $total_unassigned_nominations); $i ++)
        {
            $random_number = rand(0, $total_unassigned_nominations-1);
            array_push($nominations_to_be_assigned, $nominations[$i]);

        }
        
        $this->nominations()->saveMany($nominations_to_be_assigned);

    }

    public function RemoveNominations()
    {
        $nominations = $this->nominations()->get();

        foreach($nominations as $nomination)
        {
            $item = \App\Nomination::find($nomination['id']);
            $item->judge_id = null;
            $item->save();
        }



    }
}
