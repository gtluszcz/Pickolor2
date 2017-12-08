<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class PaletteController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth')->except('showall');
    }

    public function showall()
    {
        $palettes = App\Palette::all();

        return view('showpalettes', compact('palettes'));
    }

    public function showmy()
    {
        $palettes = App\Palette::all()->where('user_id',"=",auth()->id());


        return view('showpalettes', compact('palettes'));
    }

    public function showmyfavourite()
    {
        $user = App\User::find(auth()->id());
        $palettes = $user->fav_palettes()->get();

        return view('showpalettes', compact('palettes'));
    }
}
