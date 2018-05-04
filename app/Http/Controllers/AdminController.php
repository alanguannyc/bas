<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function indexUsers()
    {     
        $users = User::all();
        return view('user', ['users' => $users]);

    }
}
