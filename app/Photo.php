<?php

namespace App;

use Image;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Photo extends Model
{

	  protected $table = 'flyer_photos';

    protected $fillable = ['path','name','thumbnail_path'];


    protected $file;
    
    public function flyer()
    {
    	 return $this->belongsTo('App\Flyer');
    }

    public static function fromfile(UploadedFile $file)
    {
       $photo = new static;
       
       $photo->file = $file;

     return $photo->fill([
         'name'  => $photo->filename(),
         'path'  => $photo->filepath(),
         'thumbnail_path' => $photo->thumbnail_path()
        ]);

    }


    

    public function baseDir()
    {
        return 'images/photos';
    }


    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;

        $this->attributes['path'] = $this->baseDir(). '/' . $name();  

        $this->attributes['thumbnail_path'] = $this->baseDir(). '/tn-' . $name(); 

    }

   

   
    

    public function upload()
    {

        $this->file->move($this->baseDir(),$this->filename());

        $this->makeThumbnail();

        return $this;


    }

    protected function makeThumbnail()
    {
        Image::make($this->filepath())
         ->fit(200)
         ->save($this->thumbnail_path());

    }
}
