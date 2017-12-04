<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionsControler extends Controller
{
    public function create(){
        if (Auth::check()){
            return redirect()->home();
        }
        return view("login");
    }

    public function store(){
        if (!auth()->attempt(request(['name','password']))){
            return back()->withErrors([
                'message' => 'Please check your credentials'
            ]);
        }

        return redirect()->home();
    }
    public function destroy(){
        auth()->logout();
        return redirect()->home();
    }
}
