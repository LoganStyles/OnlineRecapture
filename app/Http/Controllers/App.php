<?php

namespace App\Http\Controllers;

use App\cr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class App extends Controller
{
    
    public function index()
    {
        $stored_pin=session('pin');
        $stored_clientid=session('clientID');

        if($this->checkIfLoggedIn()){
             return redirect()->action('ClientDetail@index');
        }else{
            return view('/site/index');
        }        
    }

    
    public function login()
    {
        if($this->checkIfLoggedIn()){
            return redirect()->action('ClientDetail@index');
        }else{
            return view('/site/login');
        }        
    }

    public function checkIfLoggedIn(){
        $stored_pin=session('pin');
        $stored_clientid=session('clientID');
        
        if(isset($stored_pin)&&  isset($stored_clientid)){
            return true;
        }else{
            return false;
        }
    }

    public function Logout(){

        Session::flush();
        return redirect()->route('login');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function show(cr $cr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function edit(cr $cr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cr $cr)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function destroy(cr $cr)
    {
        //
    }
}
