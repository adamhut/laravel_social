<?php
namespace App;


trait Likeable{
	public function likes()
    {
        return $this->hasMany(Like::class);
    }


    public function unlike()
    {
        //$reply->favorites()->create(['user_id' => auth()->id()]);
        $attributes=['user_id' => auth()->id()];
        if(!$this->likes()->where(['user_id'=>auth()->id()])->exists())
        {
            return $this->likes()->create(['user_id' => auth()->id(),'like'=>false]);
        }
      	if($this->isLiked())
      	{
      		return $this->likes()->where(['user_id'=>auth()->id(),'like'=>true])->update(['like'=>false]);
      	}

        return $this->likes()->where($attributes)->delete();

    }       

    public function like()
    {
        //$reply->favorites()->create(['user_id' => auth()->id()]);
        $attributes=['user_id' => auth()->id()];
        $likes = $this->likes()->where($attributes);
        if(!$this->likes()->where($attributes)->exists())
        {
            return $this->likes()->create(['user_id' => auth()->id(),'like'=>true]);
        }
        if($this->isUnliked())
      	{
      		return $this->likes()->where(['user_id'=>auth()->id(),'like'=>false])->update(['like'=>true]);
      	}
        return $this->likes()->where($attributes)->delete();
    }

    public function isLiked(){
     	return $this->likes()->where(['user_id'=>auth()->id(),'like'=>1])->exists();
    }

    public function getIsLikedAttribute()
    {
    	return $this->isLiked();
    }

    public function isUnliked(){
    	//return false;
    	return $this->likes()->where(['user_id'=>auth()->id(),'like'=>0])->exists();
    }

    public function getIsUnlikedAttribute()
    {
    	return $this->isUnliked();
    }
}