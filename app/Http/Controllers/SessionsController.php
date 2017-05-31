<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionsController extends Controller
{
    //

    public function __construct(){
        //un gest ( persona sin login) puede ver todas las vistas excepto destroy
        $this->middleware('guest',['except'=>'destroy']);
    }
    public function create(){
        return view('sessions.create');
    }


    public function store(){
        //Attempt to autenticate the user
        if(! auth()->attempt(request(['email','password'])) ){
            return back()->withErrors([
                'message'=>'Please check  your credentials and try again.'
            ]);
        }
        return redirect()->home();
    }

    public function destroy(){
        auth()->logout();
        return redirect()->home();

    }
}
