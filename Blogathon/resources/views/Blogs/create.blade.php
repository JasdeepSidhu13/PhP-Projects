@extends('layouts.app')
@section('content')
  <h1>Create Blog</h1>

  {!! Form::open(['action' => 'BlogsController@store','method'=>'POST','enctype'=> 'multipart/form-data']) !!}
      <div class="form-group">
        {{form::label('title','Title')}}
        {{form::text('title','', ['class' => 'form-control', 'placeholder' => 'Title'])}}
      </div>
      <div class="form-group">
        {{form::label('body','Body')}}
        {{form::textarea('body','', ['id'=>'article-ckeditor','class' => 'form-control', 'placeholder' => 'Body'])}}
      </div>
      <div class="form-group">
        {{Form::file('cover_image')}}

      </div>
   {{Form::submit('Submit',['class' =>"btn btn-primary"])}}
  {!! Form::close() !!}



@endsection
