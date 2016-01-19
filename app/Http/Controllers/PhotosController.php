<?php

namespace App\Http\Controllers;

use App\Flyer;
use App\AddPhotoToFlyer;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PhotosController extends Controller
{

    public function store($zip,$street,Request $request)
    {
       $this->validate($request,[
          
            'photo' => 'required|mimes:jpg,jpeg,png,bmp'
        ]);


       $flyer = Flyer::LocatedAt($zip ,$street);


       $photo = $request->file('photo');
       

       (new AddPhotoToFlyer($flyer,$photo))->save();       

    
    
    }

}
