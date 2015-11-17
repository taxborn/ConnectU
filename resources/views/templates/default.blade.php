<!DOCTYPE html>
<html lang="en">
	<head>
		@include('templates.partials.meta')
		<title>ConnectU | @yield('title')</title>
		<style>
			.parallax-container {
				height: 96vh;
			}

			hr {
			    border: 0;
			    height: 1px;
			    background: #333;
			    background-image: linear-gradient(to right, #f1f1f1, #ececec, #f1f1f1);
			}
		</style>
	</head>
	<body>
		@include('templates.partials.navigation')
		@yield('content')
		@include('templates.partials.footer')
		@include('templates.partials.scripts')
	</body>
</html>
