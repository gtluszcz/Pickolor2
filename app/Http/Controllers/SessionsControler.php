<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionsControler extends Controller
{
    public function __construct()
    {
        $this->middleware('guest',['except'=>'destroy']);
    }

    public function create(){
        return view("login");
    }

    public function store(){
//        if (!auth()->attempt(request(['name','password']))){
//            return back()->withErrors([
//                'message' => 'Please check your credentials'
//            ]);
//        }

        if (!Auth::attempt(['name' => request(['name']), 'password' => request(['password'])])) {
            return back()->withErrors([
                'message' => 'Please check your credentials'
            ]);
        }

        echo "success with username!";

        return redirect()->home();
    }
    public function destroy(){
        auth()->logout();
        return redirect()->home();
    }

    public function username()
    {
        return 'name';
    }
}
