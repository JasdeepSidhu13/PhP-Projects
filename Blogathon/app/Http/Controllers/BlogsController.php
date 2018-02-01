<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;


class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

         /**
          * Create a new controller instance.
          *
          * @return void
          */
         public function __construct()
         {
             $this->middleware('auth',['except'=> ['index','show']]);
         }

    public function index()
    {
      /*$Blogs= Blog::orderBy('title','desc')->get();*/
      $Blogs= Blog::orderBy('title','desc')->paginate(10);

    /*  $Blogs= Blog::all();*/
     return view('Blogs.index')->with('Blogs',$Blogs);
         /*->with('Blogs',$Blogs);*/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('Blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
          'title'=>'required',
          'body'=> 'required',
          'cover_image' => 'image|nullable|max:1999'
        ]);

        // Handle File Upload
        if($request->hasFile('cover_image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

       //Create Blog
       $Blog= new Blog;
       $Blog->title = $request->input('title');
       $Blog->body = $request->input('body');
       $Blog->user_id=auth()->user()->id;
       $Blog->cover_image = $fileNameToStore;
       $Blog->save();

       return redirect('/blogs')->with('success', 'Blog Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Blog=Blog::find($id);
        return view ('Blogs.show')->with('Blog',$Blog);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $Blog=Blog::find($id);

      //check for correct user
 if(auth()->user()->id !==$Blog->user_id){
   return redirect ('/blogs')->with('error','Unauthorized page');

 }

      return view ('Blogs.edit')->with('Blog',$Blog);
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
      $this->validate($request, [
        'title'=>'required',
        'body'=> 'required',

      ]);


               // Handle File Upload
              if($request->hasFile('cover_image')){
                  // Get filename with the extension
                  $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
                  // Get just filename
                  $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                  // Get just ext
                  $extension = $request->file('cover_image')->getClientOriginalExtension();
                  // Filename to store
                  $fileNameToStore= $filename.'_'.time().'.'.$extension;
                  // Upload Image
                  $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
              }


     //Create Blog
     $Blog=  Blog::find($id);
     $Blog->title = $request->input('title');
     $Blog->body = $request->input('body');
     if($request->hasFile('cover_image')){
         $Blog->cover_image = $fileNameToStore;
     }

     $Blog->save();

     return redirect('/blogs')->with('success', 'Blog Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          $Blog = Blog::find($id);

          //check for correct user
     if(auth()->user()->id !==$Blog->user_id){
       return redirect ('/blogs')->with('error','Unauthorized page');

     }

          $Blog->delete();
          return redirect('/blogs')->with('success', 'Blog Removed');
    }
}
