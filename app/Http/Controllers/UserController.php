<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = Auth::user();

       // / dd(Storage::disk('public')->allFiles());
       // dd(Storage::disk('local')->has($user->avatar. '.jpg'));
        return view('profile.index',compact('user'));
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
        //
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
    public function update($id,Request $request)
    {
        $user = Auth::user();
         //dd($user->id);
        // 
       
        if($request->hasFile('avatar') && $request->file('avatar')->isValid())
        {
            $str = Str::random(32);    
            $file = $request->file('avatar');     

            $fileName = time().'-' . $user->id . '.'.$file->getClientOriginalExtension();
            $filePath='images/avatars/'.$fileName ;
            $file =Image::make($file)->resize(300,300)->save(public_path('images/avatars/').$fileName);
            //$file =Image::make($file)->resize(300,300)->save(base_path('images/avatars/').$fileName);
  
            /*
            if(Storage::disk('local')->has($filePath))
            {
                Storage::delete($filePath);
            }
            */

            //$request->photo->storeAs('images', 'filename.jpg');
        
            //Storage::disk('public')->put($filePath, File::get($file));

            if($user->avatar!='')
            {
                $filePath=public_path('images/avatars/').$user->avatar;
                //Storage::disk('public')->delete($filePath);            
                if(File::exists($filePath))
                {
                    File::delete($filePath);
                }
            }

            //$file->storeAs('images', $fileName);
            $user->update(['avatar'=>$fileName]);
        }

        /*
        if($request->hasFile('image') && $request->file('image')->isValid())
        {
			$str = Str::random(32);    
			$file = $request->file('image');   			
        	$fileName = $str . '-' . $user->id . '.jpg';
        	$filePath='images/'.$fileName;
        	if(Storage::disk('local')->has($filePath))
        	{
				Storage::delete($filePath);
        	}

        	//$request->photo->storeAs('images', 'filename.jpg');
        
        	Storage::disk('local')->put($filePath, File::get($file));
        	//$file->storeAs('images', $fileName);
        	$user->update(['avatar'=>$fileName]);
        }
        */
       
        $result=$user->update(['name'=>request('name')]);
        if($request->wantsJson())
        {
            return response([request('name')],200);
        }else
        {
            return back();
         }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * return User Avatar file
     * @param string @fileName
     */
    public function avatar($fileName)
    {
    	$file = Storage::disk('local')->get('images/'.$fileName);
        return response($file, 200);
    }
}
