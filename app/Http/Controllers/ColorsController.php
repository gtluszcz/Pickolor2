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


    public function editexisting(App\Color $color)
    {
        $new = false;
        $comments = App\Ccomment::where("color_id","=",$color->id)->get();
        return view('color', compact('color','new', 'comments'));
    }
    public function editnew()
    {
        $new = true;
        return view('color', compact('new'));
    }

    public function colorcolor(Request $request){

//        if (!App\Color::where('hex','=',$request->input('color1', ""))->exists()){
//            $color1 = new App\Color();
//            $color1->createWithColor($request->input('color1', ""));
//            $color1->save();
//        }else{
//            $color1= App\Color::where('hex','=',$request->input('color1', ""))->first();
//        }

        //return redirect("color/$color1->id");
    }

    public function addnewcomment(Request $request){
        $comment = new App\Ccomment();
        $comment->color_id = $request->color_id;
        $comment->user_id = auth()->id();
        $comment->text = $request->text;
        $comment->setUpdatedAt(now());
        $comment->setCreatedAt(now());
        $comment->save();


        return ['success' => true, 'data' => $comment->id];

    }

    public function deletecomment(App\Ccomment $comment){
        $comment->delete();
    }

}
