<?php

namespace App;

use App\Post;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    //
    protected $guarded=[];
    

    public function user()
    {
    	$this->belongsTo(User::class);
    }

    public function post()
    {
    	$this->belongsTo(Post::class);
    }

   
}
