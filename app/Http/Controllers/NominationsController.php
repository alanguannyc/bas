<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nomination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate; 

class NominationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function home()
    {
        return view('nominationHome');
    }

    public function index()
    {        
        return $nominations = Nomination::with(['user.profile','score'])->get();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('about');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|max:255',
            'name' => 'required',
            'publish_at' => 'nullable|date',
        ]);
        // $task=Task::create(request(['title','body']));
        


        auth()->user()->publish(
            new Nomination(request(['category','title','name','q1','q2','q3','q4','q5']))
        );
        

        // session()->flash('message','Your nomination has been created!');
        // return true;
        return redirect()->home();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        
        $nomination = Nomination::where('user_id','=',auth()->id())->get();
        
        return $nomination;
    }
    
    public function showforadmin($id)
    {
        $nominations = Nomination::where('user_id','=',$id)->get();
        return view('layouts.admin.show-nomination');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        // $nomination = Nomination::with(['user.profile','score', 'final_score'])->find($id);
        $nomination = Nomination::with(['user.profile','score','final_score' => function ($query) {
            $query->where('user_id', '=', auth()->id());
        }])->find($id);
        if (Gate::denies('update-nomination', $nomination)) {
            abort(403);
        }
        return $nomination;
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $name = explode(" ", strtolower($input['name']));
        $checklist = [];

        array_push($checklist, $name[0], end($name), ucfirst($name[0]),ucfirst(end($name)), lcfirst(end($name)), lcfirst($name[0]), strtolower($name[0]),strtolower(end($name)),strtoupper($name[0]),strtoupper(end($name)) );

        foreach ($input as $key => $value) {
            if ($key == 'name') continue;
            if ($key == 'user') continue;
            
            $input[$key] = str_replace($checklist, 'xxx', $value);
            
            // echo "{$key} => {$value} ";
            
        }
        // for ($key in $request) {
        //     return $key;
        //   }
       
        
        $nomination = Nomination::findOrFail($id);
        
        // $nomination->update($request->all());
        $nomination->update($input);
        return $nomination;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Nomination::destroy($id);
    }
}
