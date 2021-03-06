<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Photo;

class Flyer extends Model
{

    protected $fillable = [
       'street',
       'city',
       'state',
       'country',
       'zip',
       'price',
       'description'
    ];

    public static function LocatedAT($zip,$street)
    {
       $street = str_replace('-', ' ', $street);

       return static::where(compact('zip','street'))->firstOrFail();
    }

    public function getPriceAttribute($price)
    {
      return '$' .number_format($price);
    }


    public function addPhoto(Photo $photo)
    {
       $this->photos()->save($photo);
    }

    public function photos()
    {
       return $this->hasMany('App\Photo');
    }
   
    public function owner()
    {
       return $this->belongTo('App\User','user_id');
    }

    public function ownedBy(User $user)
    {
       return $this->user_id == $user->id; 
    }

    
}
