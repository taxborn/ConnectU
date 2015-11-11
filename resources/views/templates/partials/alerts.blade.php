@if (Session::has('succ'))
	<div class="alert alert-dismissible alert-success" role="alert">
		<button type="button" class="close" data-dismiss="alert">×</button>
		{{ Session::get('succ') }}
	</div>
@endif

@if (Session::has('warn'))
	<div class="alert alert-dismissible alert-warning" role="alert">
		<button type="button" class="close" data-dismiss="alert">×</button>
		{{ Session::get('warn') }}
	</div>
@endif

@if (Session::has('dang'))
	<div class="alert alert-dismissible alert-danger" role="alert">
		<button type="button" class="close" data-dismiss="alert">×</button>
		{{ Session::get('dang') }}
	</div>
@endif

@if (Session::has('info'))
	<div class="alert alert-dismissible alert-info" role="alert">
		<button type="button" class="close" data-dismiss="alert">×</button>
		{{ Session::get('info') }}
	</div>
@endif