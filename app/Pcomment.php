<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pcomment extends Model
{
    public function creator(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function palette(){
        return $this->belongsTo(Palette::class,'palette_id');
    }
}
