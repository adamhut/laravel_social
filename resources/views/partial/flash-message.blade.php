@if(session()->has('flash'))
	<section class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="alert alert-success">		      
		        {!!session('flash') !!}
		    </div>
	    </div>
    </section>
@endif