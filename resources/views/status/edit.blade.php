@extends('templates.default')

@section('title')
	Edit Status
@stop

@section('content')
	<div class="row">
	    <div class="col-lg-7">
	        <form role="form" action="{{ route('status.edit', ['statusId' => $status->id]) }}" method="post">
	            <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
	                <textarea placeholder="What's up, {{ Auth::user()->getFirstNameOrUsername() }}?" name="status" class="form-control" rows="2" id="froala-editor">{!! $status->body !!}</textarea>
	            	@if ($errors->has('status'))
						<span class="help-block">{{ $errors->first('status') }}</span>
	            	@endif
	            </div>
	            <input type="hidden" name="_token" value="{{ Session::token() }}">
	            <input type="hidden" name="statusId" value="{{ $status->id }}">
	            <button type="submit" class="btn btn-primary">Update status</button>
	        </form>
	    </div>
	    <div class="col-lg-5">
			<a href="{{ route('status.delete', ['statusId' => $status->id]) }}" class="btn btn-block btn-danger">Delete Post</a>
	    </div>
	</div>
@stop
