<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Palette extends Model
{
    public function createdby(){
        return $this->belongsTo(User::class,'user_id');
    }

    protected $fillable = [
        'title', 'color1', 'color2', 'color3', 'color4', 'color5'
    ];

    public function fav_users(){
        return $this->belongsToMany(User::class);
    }

    public function color1(){
        return $this->belongsTo(Color::class,'color1_id');
    }

    public function color2(){
        return $this->belongsTo(Color::class,'color2_id');
    }

    public function color3(){
        return $this->belongsTo(Color::class,'color3_id');
    }

    public function color4(){
        return $this->belongsTo(Color::class,'color4_id');
    }

    public function color5(){
        return $this->belongsTo(Color::class,'color5_id');
    }

    public function fillcolors(array $colors = [])
    {
        if (!Color::where('hex','=',$colors[0])->exists()){
            $color1 = new Color();
            $color1->createWithColor($colors[0]);
            $color1->save();
        }else{
            $color1= Color::where('hex','=',$colors[0])->first();
        }
        $this->color1_id = $color1->id;

        if (!Color::where('hex','=',$colors[1])->exists()){
            $color2 = new Color();
            $color2->createWithColor($colors[1]);
            $color2->save();
        }else{
            $color2 = Color::where('hex','=',$colors[1])->first();
        }
        $this->color2_id = $color2->id;

        if (!Color::where('hex','=',$colors[2])->exists()){
            $color3 = new Color();
            $color3->createWithColor($colors[2]);
            $color3->save();
        }else{
            $color3 = Color::where('hex','=',$colors[2])->first();
        }
        $this->color3_id = $color3->id;

        if (!Color::where('hex','=',$colors[3])->exists()){
            $color4 = new Color();
            $color4->createWithColor($colors[3]);
            $color4->save();
        }else{
            $color4 = Color::where('hex','=',$colors[3])->first();
        }
        $this->color4_id = $color4->id;

        if (!Color::where('hex','=',$colors[4])->exists()){
            $color5 = new Color();
            $color5->createWithColor($colors[4]);
            $color5->save();
        }else{
            $color5 = Color::where('hex','=',$colors[4])->first();
        }
        $this->color5_id = $color5->id;



    }
}
