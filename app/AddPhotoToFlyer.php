<?php 


namespace App;

use use Symfony\Component\HttpFoundation\File\UploadedFile;

class AddPhotoToFlyer{
 

     protected $flyer;

     protected $file;

     public function __construct(Flyer $flyer,UploadedFile $file)
     {

     	$this->flyer = $flyer;

     	$this->file  = $file;


     }


     public function save()
     {
     	
     	$this->flyer->addphoto($this->makePhoto());

     }


     public function makePhoto()
     {

     	return new Photo('name' => $this->makeFileName());
     }

     public function makeFileName()
     {
        $name = sha1(
               time().$this->file->getClientOriginalName()
          );
          
        $extension =  $this->file->getClientOriginalExtension();

        return "{$name}.{$extension}";

     }



}

