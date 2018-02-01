@extends('layouts.app')
@section('content')
  <a href="/blogs">Go Back</a>
  <a href="/blogs/{{$Blog->id}}/edit" class="btn btn-default">Edit</a>
  <h1>{{$Blog->title}}</h1>

  <div>
      {!!$Blog->body!!}
  </div>
  <hr>
  <small>Written on {{$Blog->created_at}} by {{$Blog->user->name}}</small>
  <hr>
 @if(!Auth::guest())
   @if(Auth::user()->id==$Blog->user_id)
   <a href="/blogs/{{$Blog->id}}/edit" class="btn btn-default"></a>
    {!!Form::open(['action' => ['BlogsController@destroy', $Blog->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
        {{Form::hidden('_method', 'DELETE')}}
        {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
    {!!Form::close()!!}
  @endif
  @endif
  @endsection
