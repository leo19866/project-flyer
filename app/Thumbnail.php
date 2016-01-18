<?php 

namespace App;

use Image;

class Thumbnail {
   
   public function make($src,$destination)
   {
       Image::make($this->src)
         ->fit(200)
         ->save($this->destination);


   }



}