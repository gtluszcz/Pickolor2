<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\Auth;

class PaletteController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth')->except('showall','editexisting','editnew');
    }


    /// ALL PALETTES



    public function showall()
    {
        $palettes = App\Palette::paginate(6);

        return view('showpalettes', compact('palettes'));
    }

    public function showmy()
    {
        $palettes = App\Palette::where('user_id',"=",auth()->id())->paginate(6);


        return view('showpalettes', compact('palettes'));
    }

    public function showmyfavourite()
    {
        $user = App\User::find(auth()->id());
        $palettes = $user->fav_palettes()->paginate(6);

        return view('showpalettes', compact('palettes'));
    }

    public function like_palette(App\Palette $palette){
        $palette->likes+=1;
        $palette->save();
        auth()->user()->fav_palettes()->attach($palette);
    }

    public function unlike_palette(App\Palette $palette){
        $palette->likes-=1;
        $palette->save();
        auth()->user()->fav_palettes()->detach($palette);

    }
    public function deletepalette(App\Palette $palette){
        $palette->fav_users()->detach();
        $palette->delete();
    }



    ////PALETTE


    public function editexisting(App\Palette $palette)
    {
        $new = false;
        return view('palette', compact('palette','new'));
    }
    public function editnew()
    {
        $new = true;
        return view('palette', compact('new'));
    }

    public function save(App\Palette $palette, Request $request)
    {
        if(auth()->id()==$palette->createdby->id){
            $palette->title = $request->input('palettetitle', 'unnamed');
            $colors[0] = $request->input('color1', "");
            $colors[1] = $request->input('color2', "");
            $colors[2] = $request->input('color3', "");
            $colors[3] = $request->input('color4', "");
            $colors[4] = $request->input('color5', "");
            $palette->fillcolors($colors);
            $palette->setUpdatedAt(now());
            $palette->save();

        }
        else{
            $palette = new App\Palette();
            $palette->title = $request->input('palettetitle', 'unnamed');
            $palette->user_id = auth()->id();
            $colors[0] = $request->input('color1', "");
            $colors[1] = $request->input('color2', "");
            $colors[2] = $request->input('color3', "");
            $colors[3] = $request->input('color4', "");
            $colors[4] = $request->input('color5', "");
            $palette->fillcolors($colors);
            $palette->views = 0;
            $palette->likes = 0;
            $palette->setUpdatedAt(now());
            $palette->setCreatedAt(now());
            $palette->save();

        }
        $new = false;
        return view('palette', compact('palette','new'));
    }

    public function savenew(Request $request)
    {

        $palette = new App\Palette();
        $palette->title = $request->input('palettetitle', 'unnamed');
        $palette->user_id = auth()->id();
        $colors[0] = $request->input('color1', "");
        $colors[1] = $request->input('color2', "");
        $colors[2] = $request->input('color3', "");
        $colors[3] = $request->input('color4', "");
        $colors[4] = $request->input('color5', "");
        $palette->fillcolors($colors);
        $palette->views = 0;
        $palette->likes = 0;
        $palette->setUpdatedAt(now());
        $palette->setCreatedAt(now());
        $palette->save();

        return redirect("palette/$palette->id");
    }
}
