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



    public function showall(Request $request)
    {

        switch ($request->query('order','likes')){
            case 'likes':
                $palettes = App\Palette::orderBy('likes', 'desc')->paginate(6);
                break;
            case 'views':
                $palettes = App\Palette::orderBy('views', 'desc')->paginate(6);
                break;
            case 'oldest':
                $palettes = App\Palette::orderBy('created_at', 'asc')->paginate(6);
                break;
            case 'newest':
                $palettes = App\Palette::orderBy('created_at', 'desc')->paginate(6);
                break;

        }

        return view('showpalettes', compact('palettes'));
    }

    public function showmy(Request $request)
    {
        switch ($request->query('order','likes')){
            case 'likes':
                $palettes = App\Palette::where('user_id',"=",auth()->id())->orderBy('likes', 'desc')->paginate(6);
                break;
            case 'views':
                $palettes = App\Palette::where('user_id',"=",auth()->id())->orderBy('views', 'desc')->paginate(6);
                break;
            case 'oldest':
                $palettes = App\Palette::where('user_id',"=",auth()->id())->orderBy('created_at', 'asc')->paginate(6);
                break;
            case 'newest':
                $palettes = App\Palette::where('user_id',"=",auth()->id())->orderBy('created_at', 'desc')->paginate(6);
                break;

        }

        return view('showpalettes', compact('palettes'));
    }

    public function showmyfavourite(Request $request)
    {
        $user = App\User::find(auth()->id());
        switch ($request->query('order','likes')){
            case 'likes':
                $palettes = $user->fav_palettes()->orderBy('likes', 'desc')->paginate(6);
                break;
            case 'views':
                $palettes = $user->fav_palettes()->orderBy('views', 'desc')->paginate(6);
                break;
            case 'oldest':
                $palettes = $user->fav_palettes()->orderBy('created_at', 'asc')->paginate(6);
                break;
            case 'newest':
                $palettes = $user->fav_palettes()->orderBy('created_at', 'desc')->paginate(6);
                break;

        }

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
        $comments = App\Pcomment::where("palette_id","=",$palette->id)->get();
        return view('palette', compact('palette','new', 'comments'));
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
        $comments = App\Pcomment::where("palette_id","=",$palette->id)->get();
        return view('palette', compact('palette','new', 'comments'));
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
    public function addnewcomment(Request $request){
        $comment = new App\Pcomment();
        $comment->palette_id = $request->palette_id;
        $comment->user_id = auth()->id();
        $comment->text = $request->text;
        $comment->setUpdatedAt(now());
        $comment->setCreatedAt(now());
        $comment->save();


        return ['success' => true, 'data' => $comment->id];

    }

    public function deletecomment(App\Pcomment $comment){
        $comment->delete();
    }
}
