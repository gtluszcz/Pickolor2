<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\Auth;

class PaletteController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth')->except('showall','editexisting');
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

    public function editexisting(App\Palette $palette)
    {
        return view('palette', compact('palette'));
    }

    public function save(App\Palette $palette, Request $request)
    {
        if(auth()->id()==$palette->createdby->id){
            $palette->title = $request->input('palettetitle', 'unnamed');
            $palette->color1 = $request->input('color1', "");
            $palette->color2 = $request->input('color2', "");
            $palette->color3 = $request->input('color3', "");
            $palette->color4 = $request->input('color4', "");
            $palette->color5 = $request->input('color5', "");
            $palette->setUpdatedAt(now());
            $palette->save();

        }
        else{
            $palette = new App\Palette();
            $palette->title = $request->input('palettetitle', 'unnamed');
            $palette->user_id = auth()->id();
            $palette->color1 = $request->input('color1', "");
            $palette->color2 = $request->input('color2', "");
            $palette->color3 = $request->input('color3', "");
            $palette->color4 = $request->input('color4', "");
            $palette->color5 = $request->input('color5', "");
            $palette->views = 0;
            $palette->likes = 0;
            $palette->setUpdatedAt(now());
            $palette->setCreatedAt(now());
            $palette->save();

        }
        return view('palette', compact('palette'));
    }
}
