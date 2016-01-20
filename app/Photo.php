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


    public function baseDir()
    {
        return 'images/photos';
    }


    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;

        $this->path = $this->basedir().'/'.$name;

        $this->thumbnail_path = $this->basedir().'/tn-'.$name; 


    }

    public static function named($name)
    {
     
       return (new static)->saveAs($name);

    } 

    public function delete()
    {
       \File::delete([
           
           $this->path,
           $this->thumbnail_path

        ]);

       parent::delete();

    }

    

}
