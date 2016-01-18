<?php

namespace App;

use Image;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Photo extends Model
{

	  protected $table = 'flyer_photos';

    protected $fillable = ['path','name','thumbnail_path'];


    
    public function flyer()
    {
    	 return $this->belongsTo('App\Flyer');
    }


    public function filename()
    {
        $name = sha1(
               time().$this->file->getClientOriginalName()
          );
          
        $extension =  $this->file->getClientOriginalExtension();

        return "{$name}.{$extension}";
    }

    public function filepath()
    {
       return $this->baseDir(). '/' . $this->filename();

    }

    public function baseDir()
    {
        return 'images/photos';
    }

    public function thumbnail_path()
    {
        return $this->baseDir(). '/tn-' .$this->filename(); 
    }

    public static function named($name)
    {
     
       return (new static)->saveAs($name);

    } 

    

}
