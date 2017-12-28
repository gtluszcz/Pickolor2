<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'hex',
    ];

    public function createWithColor($color)
    {
        $this->hex = $color;
        $this->user_id = auth()->id();
        $this->setUpdatedAt(now());
        $this->setCreatedAt(now());
        $this->likes = 0;
    }

    public function createdby(){
        return $this->belongsTo(User::class,'user_id');
    }


    public function fav_users(){
        return $this->belongsToMany(User::class);
    }
}
