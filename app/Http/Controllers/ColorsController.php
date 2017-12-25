<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\Auth;

class ColorsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('showall','editexisting','editnew');
    }

    public function showall(Request $request)
    {
        switch ($request->query('order','likes')){
            case 'likes':
                $colors = App\Color::orderBy('likes', 'desc')->paginate(30);
                break;
            case 'oldest':
                $colors = App\Color::orderBy('created_at', 'asc')->paginate(30);
                break;
            case 'newest':
                $colors = App\Color::orderBy('created_at', 'desc')->paginate(30);
                break;

        }

        return view('showcolors', compact('colors'));
    }


    public function showmyfavourite(Request $request)
    {

        $user = App\User::find(auth()->id());
        switch ($request->query('order','likes')){
            case 'likes':
                $colors = $user->fav_colors()->orderBy('likes', 'desc')->paginate(30);
                break;
            case 'oldest':
                $colors = $user->fav_colors()->orderBy('created_at', 'asc')->paginate(30);
                break;
            case 'newest':
                $colors = $user->fav_colors()->orderBy('created_at', 'desc')->paginate(30);
                break;

        }

        return view('showcolors', compact('colors'));
    }

    public function like_color(App\Color $color){
        $color->likes+=1;
        $color->save();
        auth()->user()->fav_colors()->attach($color);
    }

    public function unlike_color(App\Color $color){
        $color->likes-=1;
        $color->save();
        auth()->user()->fav_colors()->detach($color);

    }




    ////PALETTE


    public function editexisting(App\Palette $palette)
    {
        $new = false;
        $comments = App\Pcomment::where("palette_id","=",$palette->id)->get();
        return view('palette', compact('palette','new', 'comments'));
    }
    public function editnew()
    {
        $new = true;
        return view('palette', compact('new'));
    }

}
