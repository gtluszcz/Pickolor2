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
}
