@extends('layouts.master')

@section('title')
	User Profile
@endsection


@section('content')
{{--
	<section class="row new-post">
        <div class="col-md-6 col-md-offset-3">
            <header><h3>Your Account</h3></header>
            <form action="{{ route('user.update',$user->id) }}" method="post" enctype="multipart/form-data">
               	{{csrf_field()}}
               	{{method_field('PATCH')}}
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" id="name">
                </div>
                <div class="form-group">
                    <label for="image">Image (only .jpg)</label>
                    <input type="file" name="image" class="form-control" id="image">
                </div>
                <button type="submit" class="btn btn-primary">Save Account</button>
            </form>
        </div>
    </section>
	@if (Storage::disk('local')->has('images/'.$user->avatar))
        <section class="row new-post">
            <div class="col-md-6 col-md-offset-3">
                <img src="{{route('user.avatar',$user->avatar)}}" alt="" class="img-responsive">
                
            </div>
        </section>
    @endif
--}}
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            
            @if (File::exists(public_path('/images/avatars/'.$user->avatar)))
            <img src="/images/avatars/{{ $user->avatar }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;" class="    img-circle">
            @else
            <img src="http://placehold.it/150x150" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;" class="img-circle">
            @endif
            <h2>{{ $user->name }}'s Profile</h2>
    
            <profile :data="{{$user}}"></profile>
            {{--
             <form enctype="multipart/form-data" action="{{route('user.update',$user->id) }}" method="POST">
                {{csrf_field()}}
                {{method_field('PATCH')}}
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" id="name">
                </div>
                <div class="form-group">
                    <label for="image">Update Profile Image</label>
                    <input type="file" name="avatar" class="form-control" id="avatar">
                </div>
                <label>Update Profile Image</label>
                <input type="file" name="avatar">
                
                
                <input type="submit" class="pull-right btn btn-sm btn-primary">
            </form>
            --}}
        </div>
    </div>
</div>

@endsection
