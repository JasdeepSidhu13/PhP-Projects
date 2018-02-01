@extends('layouts.app')
@section('content')
  <h1>Create Blog</h1>

  {!! Form::open(['action' => ['BlogsController@update',$Blog->id],'method'=>'POST','enctype'=> 'multipart/form-data']) !!}
      <div class="form-group">
        {{form::label('title','Title')}}
        {{form::text('title',$Blog->title, ['class' => 'form-control', 'placeholder' => 'Title'])}}
      </div>
      <div class="form-group">
        {{form::label('body','Body')}}
        {{form::textarea('body',$Blog->body, ['id'=>'article-ckeditor','class' => 'form-control', 'placeholder' => 'Body'])}}
      </div>
      <div class="col-md-4 col-sm-4">
          <img style="width:100%" src="/storage/cover_images/{{$Blog->cover_image}}">
      </div>
      {{Form::hidden('_method','PUT')}}
   {{Form::submit('Submit',['class' =>"btn btn-primary"])}}
  {!! Form::close() !!}



@endsection
