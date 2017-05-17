<?php

namespace App;

use App\Like;
use App\User;
use App\Likeable;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    //
    use Likeable;
    
    protected $fillable=['body','user_id'];

    protected $with=['likes'];

    protected $appends= ['isUnliked','isLiked'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    
    
}
