@extends('layouts.master')

@section('title')
	Dashboard2
@endsection

@section('content')

<section class="row new-post">
	<div class="col-md-6 col-md-offset-3">
		@include('partial.flash-message')
		<header>
			<h3>What do you have to say</h3>
		</header>
		<form action="{{route('create.post')}}" method="POST">
			{{csrf_field()}}
			<div class="form-group">
				<textarea name="body" id="body" cols="30" rows="10" class="form-control">{{old('body')}}</textarea>
			</div>
			<button class="btn btn-primary">Create Post</button>
		</form>
	</div>
</section>
<section class="row posts">
	<div class="col-md-6 col-md-offset-3">
		<header>
			<h3>What do other people sad</h3>
		</header>


		@foreach($posts as $post)
			@include('partial.post')
			
		@endforeach
		{{$posts->links()}}
		
	</div>
</section>
 <!-- modal-->
    <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Edit Post</h4>
          </div>
          <div class="modal-body">
            <form action="/post/">
            	
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

@endsection


@section('footerScript')
<script src="/js/tinymce/tinymce.min.js"></script>
<script>
 	 var editor_config = {
    path_absolute : "/",
    selector: "textarea#body",
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    relative_urls: false,
    file_browser_callback : function(field_name, url, type, win) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
      if (type == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }

      tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no"
      });
    }
  };
    tinymce.init(editor_config);
  </script>﻿
@endsection