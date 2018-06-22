<?php

namespace App;
use App\Mail\NewNominations;
use Illuminate\Support\Facades\Mail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function nominations() {
        return $this->hasMany('App\Nomination');
    }

    public function roles() {
        return $this->belongsToMany('App\Role');
    }

    // public function role() {
    //     return $this->hasOne('App\Role');
    // }

    public function profile()
    {
        return $this->hasOne('App\Profile');
    }

    public function publish($nomination) {
        $this->nominations()->save($nomination);
        
        Mail::to(auth()->user())->send(new NewNominations($nomination));
    }

    public function addProfile($profile) {
        // $this->profile()->save($profile);
        // foreach($profile as $key=>$val) {
        //     array_push($results, $obj);
        // }
        $this->profile()->updateOrCreate(['user_id'=>$this->id],['company'=>$profile->company, 'address'=>$profile->address, 'title'=>$profile->title,'phone'=>$profile->phone]);

    }

    public function isAdmin()
    {
        foreach ($this->roles()->get() as $role)
        {
            if ($role->name == 'admin')
            {
                return true;
            }
        }
        return false;
    }

    public function isJudge()
    {
        foreach ($this->roles()->get() as $role)
        {
            if ($role->name == 'judge')
            {
                return true;
            }
        }
        return false;
    }

    public function completedProfile()
    {
        if(!$this->profile || !$this->profile->company) {
            // return redirect()->intended('/admin');
            return false;
        }
        return true;
    }
}
