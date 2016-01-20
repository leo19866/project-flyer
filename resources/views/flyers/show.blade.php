@extends('layout')


@section('content')

<div class="row">
    <div class="col-md-3">
     <h1>{!! $flyer->street !!}</h1>
     <h1>{!! $flyer->price !!}</h1>

     <hr>

     <div class="description">{!! nl2br($flyer->description) !!}</div>
    </div>

    <div class="col-md-8 gallery">
       @foreach($flyer->photos->chunk(4) as $set)
          <div class="row">
              @foreach($set as $photo)
                <div class="col-md-3 gallery__image">  
                  <form method="POST" action="/photos/{{$photo->id}}">
                    {!! csrf_field() !!}

                      <input type="hidden" name="_method" value="DELETE">
                      
                      <button type="submit">Delete</button>
                  </form>

                  <img src="/{{ $photo->thumbnail_path }}">  
                </div> 
    	        @endforeach
          </div> 
       @endforeach 

         <hr>
   @if( $user && $user->owns($flyer) )

    <h2>Add Your Photos</h2>
 
       <form  id="addPhotosForm" action="{{ route('store_photo_path',[ $flyer->zip , $flyer->street ] )}}" method="POST" class="dropzone">      
      {{ csrf_field()}}
      </form>
    </div>

   @endif 
</div>



@stop

@section('scripts.footer')
   <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/dropzone.js"></script>
   <script>
      Dropzone.options.addPhotosForm = {
        paramName: 'photo',
        
        maxFilesize: 3,
 
        acceptedFiles: '.jpg, .jpeg, .png, .bmp'
      };
   </script>

@stop   


