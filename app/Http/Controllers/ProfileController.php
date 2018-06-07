<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show()
    {
        
        // return $profile = Profile::find(22);
        return $profile = Profile::where('user_id','=',auth()->id())->get();
    }
 
    public function store(Request $request)
    {
        $request->validate([
            'company' => 'required|max:255',
            'address' => 'nullable',
            'title' => 'required',
            'phone' => 'nullable',
        ]);
        // $task=Task::create(request(['title','body']));
        

        $profile = auth()->user()->addProfile(
            new Profile(request(['company','address','title','phone']))
        );
        $uid = auth()->user()->id;
        // $profile = \App\Profile::updateOrCreate(['user_id'=>$uid, 'company'=>$request->company, 'address'=>$request->address, 'title'=>$request->title,'phone'=>$request->phone]);


        return $profile;
    }
}
