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
		<!-- jQuery -->
		<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
		<!-- Bootstrap JS -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<!-- Bootstrap -->
		<link rel="stylesheet" href="https://bootswatch.com/paper/bootstrap.min.css">
		<!-- WYSIWYG Editor -->
		<script src="//tinymce.cachefly.net/4.2/tinymce.min.js"></script>
	    @if ($_SERVER['SERVER_NAME'] === 'localhost')
		    <script type="text/javascript">
		        tinymce.init({
		            mode: "textareas",
					plugins: "anchor",
					theme: "modern",
					skin_url: "/ConnectU/resources/assets/skins/light",
					plugins : 'advlist autolink link image lists charmap print preview'
		        });
		    </script>
		@elseif ($_SERVER['SERVER_NAME'] === 'www.connectu.xyz')
			<script type="text/javascript">
		        tinymce.init({
		            mode: "textareas",
					plugins: "anchor",
					theme: "modern",
					skin_url: "/resources/assets/skins/light",
					plugins : 'advlist autolink link image lists charmap print preview'
		        });
		    </script>
	    @endif
	</head>
	<body>
		@include('templates.partials.navigation')
		<div class="container">
			@include('templates.partials.alerts')
			@yield('content')
		</div>
		<br>
		<br>
		@include('templates.partials.footer')
		<script type="text/javascript">
			var _mfq = _mfq || [];
			(function() {
				var mf = document.createElement("script");
				mf.type = "text/javascript"; mf.async = true;
				mf.src = "//cdn.mouseflow.com/projects/b58c1ac3-757b-42a1-b726-10b9799eb623.js";
				document.getElementsByTagName("head")[0].appendChild(mf);
			})();

			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
				(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
				m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-68363643-1', 'auto');
			ga('send', 'pageview');
		</script>
	</body>
</html>
