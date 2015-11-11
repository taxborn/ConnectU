@extends('templates.default')

@section('title')
	Delete
@stop

@section('content')
	<h3>Delete your account</h3>
	<em>Warning: This action is irreversible.</em>
	<br>
	<br>
	<div class="row">
	    <div class="col-lg-6">
	        <form class="form-vertical" role="form" method="post" action="{{ route('profile.delete') }}">
	            <div class="row">
	                <div class="col-lg-6">
	                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
	                        <label for="password" class="control-label">Your password</label>
	                        <input type="password" name="password" class="form-control" id="password">
	                    	@if ($errors->has('password'))
								<span class="help-block">{{ $errors->first('password') }}</span>
	                    	@endif
	                    </div>
	                </div>
	            </div>
	            <div class="form-group">
	                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirm-modal">Delete Account</button>
					<div class="modal fade" id="confirm-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel">Are you sure?</h4>
								</div>
								<div class="modal-body">
									This action will <em>permanently</em> delete your account and this action is not reverseable. Use with caution.
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-danger">Delete Account</button>
								</div>
							</div>
						</div>
					</div>
	            </div>
	            <input type="hidden" name="_token" value="{{ Session::token() }}">
	        </form>
	    </div>
	</div>
@stop
