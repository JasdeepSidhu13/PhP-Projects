<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'Blogs';
    public $primaryKey ='id';
    public $timestamps=true;

    public function user(){
      return $this->belongsTo('App\User');
    }
}
