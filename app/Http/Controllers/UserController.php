<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($id)
    {
        
        // return $profile = Profile::find(22);
        $user = User::with(['profile'])->get()->find($id);
        return $user; 
    }

    public function index()
    {
        return view('layouts.admin.show-member'); 
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
 
        return $user;
    }
}
