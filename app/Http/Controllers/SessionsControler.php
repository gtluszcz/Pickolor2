<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionsControler extends Controller
{
    public function create(){
        return view("login");
    }
    public function destroy(){
        auth()->logout();
        return redirect()->home();
    }
}
