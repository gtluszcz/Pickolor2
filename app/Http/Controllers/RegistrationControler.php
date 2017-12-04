<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\User;

class RegistrationControler extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function create(){

        return view('register');
    }

    public function store(){
        $this->validate(request(),[
            'name'=> 'required|unique:users',
            'email'=>'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);


        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password'))
        ]);

        auth()->login($user);

        return redirect()->home();
    }

}
