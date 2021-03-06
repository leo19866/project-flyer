<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FlyerRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\AuthorizesUsers;
use App\Flyer;
use App\Photo;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class FlyersController extends Controller
{
   use AuthorizesUsers;

   public function __construct()
   {

      $this->middleware('auth',['except'=>'show']);
      

      parent::__construct();

   }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.home');
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //flash('success','Hello World');  
   
       flash()->overlay('success','Hello World');      
 
       return view('flyers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FlyerRequest $request)
    {
       
        Flyer::create($request->all());

        flash()->success('success','Flyer successfully created !','success');

        return redirect()->back();
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($zip,$street)
    {
        
         //return Flyer::LocatedAt($zip ,$street)->first();

        $flyer = Flyer::LocatedAt($zip ,$street);
       
        return view('flyers.show',compact('flyer'));
    }


    public function addPhoto($zip,$street,Request $request)
    {
       $this->validate($request,[
          
            'photo' => 'required|mimes:jpg,jpeg,png,bmp'
        ]);

       $photo = Photo::fromfile($request->file('photo'))->upload();

       Flyer::LocatedAt($zip ,$street) ->addPhoto($photo);
    
    /*
       if (! $this->userCreateFlyer($request)) {

            return $this->unauthorized($request);
       }


       $photo = $this->makePhoto($request->file('photo'));

       Flyer::LocatedAt($zip ,$street) ->addPhoto($photo);
    */
    }

    

    public function makePhoto(UploadedFile $file)
    {

        return Photo::named($file->getClientOriginalName())->move($file);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
