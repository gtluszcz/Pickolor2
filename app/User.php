<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function createdpalettes(){
        return $this->hasMany(Palette::class);
    }


    public function fav_palettes(){
        return $this->belongsToMany(Palette::class);
    }

    public function has_fav_palette(Palette $palette)
    {
        foreach ($this->fav_palettes()->get() as $pal)
        {
            if ($pal->id == $palette->id)
            {
                return true;
            }
        }

        return false;
    }
}
