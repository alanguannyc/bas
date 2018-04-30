<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nomination;
use Illuminate\Support\Facades\DB;

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
        
            return $nominations = Nomination::where('user_id','=',auth()->id())->get();
    
         

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
            new Nomination(request(['category','name','q1','q2','q3','q4','q5']))
        );

        session()->flash('message','Your task has been created!');

        return redirect()->home();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $nomination = Nomination::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $nomination = Nomination::find($id);
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
        $nomination = Nomination::findOrFail($id);
        $nomination->update($request->all());
 
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
        //
    }
}
