<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\User;

class RegistrationControler extends Controller
{
    public function create(){
        return view('register');
    }

    public function store(){
        $this->validate(request(),[
            'name'=> 'required',
            'email'=>'required|email',
            'password' => 'required'
        ]);


        $user = User::create(request(['name','email','password']));

        auth()->login($user);

        return redirect('home');
    }

}
