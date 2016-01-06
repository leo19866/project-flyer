@extends('layout')


@section('content')

 <h1>{!! $flyer->street !!}</h1>
 <h1>{!! $flyer->price !!}</h1>
 
 <div class="description">{!! nl2br($flyer->description) !!}</div>

@stop


