<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // $user = $user->update($request->except('role'));
        // dd($request);
        if ($request->role == 'admin') {
            $user->roles()->sync([1]);
        } else if ($request->role == 'member'){
            $user->roles()->sync([2]);
        } else if ($request->role == 'judge'){
            $user->roles()->sync([3]);
            $judge = \App\Judge::find($id);
            $judge->AssignNominations();

        } else if ($request->role == 'final_judge'){
            $user->roles()->sync([4]);
        }

        return [$user->roles()];
    }

    
}
