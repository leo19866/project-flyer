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

       return static::where(compact('zip','street'))->first();
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

    
}
