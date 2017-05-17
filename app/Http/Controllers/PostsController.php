<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
	public function __contruct()
	{
		$this->middleware('auth')->except([
			'index'
		]);
	}
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
   		$posts = Auth::user()->posts()->latest()->paginate();
   		
        return view('dashboard',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation
        $this->validate($request,[
        	'body' => 'required|min:10|max:1000',
        ]);

        $post = Post::create([
        	'user_id' => auth()->id(),
        	'body'	=> request('body'),
        ]);
        $message ="There was a error when POST your post";
        if($post){
        	$message="Your Post has been publish";
        }
        return redirect()->route('posts')
            ->with('flash',$message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( Post $post)
    {
        //$post = Post::find($id);
        //dd(request('body'),$post->id);
        $this->authorize('update',$post);
        //echo $post->id;
        $post->update(['body'=>request('body')]);

        if(request()->wantsJson())
        {
            return response(['message'=>'Post edited'],204);
        }
        return redirect()->route('dashboard')
            ->with(['message'=>'Post edited']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
        $this->authorize('update',$post);
        $post->delete();
        return redirect()
        	->route('posts')
        	->with([
        		'flash'=>'Your message Has been delete',
        	]);
    }

    public function unlike(Post $post)
    {
        //$reply->favorites()->create(['user_id' => auth()->id()]);
        if(!$this->like()->where(['user_id'=>auth()->id()])->exists())
        {
            return $this->like()->create(['user_id' => auth()->id(),'like'=>false]);
        }
        $attributes = ['user_id'=>auth()->id()];
        $this->likes()->where($attributes)->update(['like'=>false]);

    }       

    public function like(Post $post)
    {
        //$reply->favorites()->create(['user_id' => auth()->id()]);
        if(!$this->like()->where(['user_id'=>auth()->id()])->exists())
        {
            return $this->like()->create(['user_id' => auth()->id(),'like'=>true]);
        }
        return $this->likes()->where($attributes)->update(['like'=>true]);
    }

    
}
