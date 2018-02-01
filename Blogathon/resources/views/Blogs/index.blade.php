@extends('layouts.app')
@section('content')
  <h1>Blogs</h1>

  @if(count($Blogs)>0)
    @foreach ($Blogs as $Blog)
         <div class="well">
           <div class="row">
               <div class="col-md-4 col-sm-4">
                   <img style="width:100%" src="/storage/cover_images/{{$Blog->cover_image}}">
               </div>
               <div class="col-md-8 col-sm-8">
           <h3><a href="/blogs/{{$Blog->id}}">{{$Blog->title}}</a></h3>
           <small>Written on {{$Blog-> created_at}} by {{$Blog->user->name}}</small>
         </div>
       </div>
     </div>
    @endforeach
    {{$Blogs->links()}}
  @else
    <h3>No Posts found</h3>
  @endif

@endsection
