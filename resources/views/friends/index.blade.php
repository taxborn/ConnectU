@extends('templates.default')

@section('title')
	Friends
@stop

@section('content')
	<div class="row">
	    <div class="col-lg-6">
	        <div class="panel panel-primary">
	        	<div class="panel-heading">
	        		<h5 class="text-center" style="color: white;">Your Friends</h5>
	        	</div>
	        	<div class="panel-body">
	        		 <!-- List of friends -->
			        @if (!$friends->count())
						<p class="text-center">You have no friends.</p>
			        @else
						@foreach ($friends as $user)
							@include('user.partials.userblock')
						@endforeach
			        @endif
	        	</div>
	        </div>
	    </div>
	    <div class="col-lg-6">
	        <div class="panel panel-primary">
	        	<div class="panel-heading">
	        		<h5 class="text-center" style="color: white;">Friend Requests</h5>
	        	</div>
	        	<div class="panel-body">
	        		<!-- List of friend requests -->
			        @if (!$requests->count())
						<p class="text-center">You have no friend requests.</p>
			        @else
						@foreach ($requests as $user)
							@include('user.partials.userblock')
						@endforeach
			        @endif
	        	</div>
	        </div>
	    </div>
	</div>
@stop