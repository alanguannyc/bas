<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AdminController extends WinnersController
{
    public function indexUsers()
    {     
        $users = User::all();
        return view('layouts.admin.user');

    }

    public function index() 
    {
        $winners = WinnersController::winner();
        return view('layouts.admin.index')->with('winners', $winners);
    }

    public function winners()
    {
        $winners = WinnersController::winner();


        if($winners != null) {
            return view('layouts.admin.index-winner-list')->with('winners', $winners);
        } else {
            return view('layouts.admin.index-winner-list');
        }
        
    }
}
