<post inline-template v-cloak :attributes="{{$post}}">
	<article class="post">
		<div v-if="editing">
            <div class="form-group">
                <textarea class="form-control" v-model="body"></textarea>
            </div>
            <button class="btn btn-xs btn-primary mr-1" @click="update">Update</button>
            <button class="btn btn-xs btn-link mr-1" @click="editing=false">Cancel</button>
        </div>
        <div class="body" v-else v-html="body"></div>
        <hr>
		<div class="info">
			Post By {{$post->user->name}} on {{$post->created_at->diffForHumans()}} {{$post->isUnliked ? 'I do not like':'I do'}}
		</div>
		<div class="interaction level">
			<span v-show=""></span>
			<button class="btn btn-link btn-xs" @click="like"><i :class="likedClasses" aria-hidden="true"></i></button> |
			<button class="btn btn-link btn-xs" @click="unlike"><i :class="unlikedClasses" aria-hidden="true"></i></button> |
			<button  class="btn btn-link btn-xs" @click="editing=true"><i class="fa fa-pencil" aria-hidden="true"></i></button> |
			<form method="POST" action="{{route('delete.post',$post->id)}}">
				{{csrf_field()}}
				{{method_field('DELETE')}}
				<button class="btn btn-link" type="submit">
					<i class="fa fa-trash" aria-hidden="true"></i>
				</button>
			</form>
		</div>
	</article>
</post>