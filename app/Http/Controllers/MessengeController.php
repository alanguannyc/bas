<?php

namespace App\Http\Controllers;

use App\Messenge;
use Illuminate\Http\Request;

class MessengeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $msg = new Messenge(request(['text']));
        // dd(request(['text']));
        // $msg->text = $request;
        $msg = \App\Messenge::create(request(['text']));
        // dd($request);
        return $msg;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Messenge  $messenge
     * @return \Illuminate\Http\Response
     */
    public function show(Messenge $messenge)
    {
         return $msg = \App\Messenge::latest()->first();
        //  dd($msg);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Messenge  $messenge
     * @return \Illuminate\Http\Response
     */
    public function edit(Messenge $messenge)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Messenge  $messenge
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Messenge $messenge)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Messenge  $messenge
     * @return \Illuminate\Http\Response
     */
    public function destroy(Messenge $messenge)
    {
        //
    }
}
