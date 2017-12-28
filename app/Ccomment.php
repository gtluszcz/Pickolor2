<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ccomment extends Model
{
    public function creator(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function palette(){
        return $this->belongsTo(Color::class,'color_id');
    }
}
