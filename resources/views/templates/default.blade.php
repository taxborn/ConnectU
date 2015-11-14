<!DOCTYPE html>
<html lang="en">
	<head>
		@include('templates.partials.meta')
		<title>ConnectU | @yield('title')</title>
		<style>
			.label-pink {
				background-color: #e9a3a3;
			}
		</style>
	</head>
	<body>
		@include('templates.partials.navigation')
		<div class="container">
			@yield('content')
		</div>
		@include('templates.partials.footer')
		@include('templates.partials.scripts')
	</body>
</html>
