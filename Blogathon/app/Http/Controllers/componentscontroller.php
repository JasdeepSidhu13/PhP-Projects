<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class componentscontroller extends Controller
{
    public function home(){
      $title ='Welcome to the home page';
      return view ('components.home')->with('title',$title);

    }

        public function info(){
          return view ('components.info');

        }


}
