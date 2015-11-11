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
		<!-- Font Awesome -->
		<link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<!-- Froala Editor -->
		<link href="/ConnectU/resources/assets/css/froala_editor.min.css" rel="stylesheet" type="text/css" />
 		<link href="/ConnectU/resources/assets/css/froala_style.min.css" rel="stylesheet" type="text/css" />
		<!-- Froala Editor Plugins -->
		<link rel="stylesheet" href="/ConnectU/resources/assets/css/plugins/char_counter.css">
		<link rel="stylesheet" href="/ConnectU/resources/assets/css/plugins/code_view.css">
		<link rel="stylesheet" href="/ConnectU/resources/assets/css/plugins/colors.css">
		<link rel="stylesheet" href="/ConnectU/resources/assets/css/plugins/emoticons.css">
		<link rel="stylesheet" href="/ConnectU/resources/assets/css/plugins/file.css">
		<link rel="stylesheet" href="/ConnectU/resources/assets/css/plugins/fullscreen.css">
		<link rel="stylesheet" href="/ConnectU/resources/assets/css/plugins/image.css">
		<link rel="stylesheet" href="/ConnectU/resources/assets/css/plugins/image_manager.css">
		<link rel="stylesheet" href="/ConnectU/resources/assets/css/plugins/line_breaker.css">
		<link rel="stylesheet" href="/ConnectU/resources/assets/css/plugins/table.css">
		<link rel="stylesheet" href="/ConnectU/resources/assets/css/plugins/video.css">
	</head>
	<body>
		@include('templates.partials.navigation')
		<div class="container fr-view">
			@include('templates.partials.alerts')
			@yield('content')
		</div>
		<br>
		<br>
		@include('templates.partials.footer')
		<!-- Include JS files. -->
		  <script src="/ConnectU/resources/assets/js/froala_editor.min.js"></script>

		  <!-- Include Plugins. -->
		  <script type="text/javascript" src="/ConnectU/resources/assets/js/plugins/align.min.js"></script>
		  <script type="text/javascript" src="/ConnectU/resources/assets/js/plugins/char_counter.min.js"></script>
		  <script type="text/javascript" src="/ConnectU/resources/assets/js/plugins/code_view.min.js"></script>
		  <script type="text/javascript" src="/ConnectU/resources/assets/js/plugins/colors.min.js"></script>
		  <script type="text/javascript" src="/ConnectU/resources/assets/js/plugins/emoticons.min.js"></script>
		  <script type="text/javascript" src="/ConnectU/resources/assets/js/plugins/entities.min.js"></script>
		  <script type="text/javascript" src="/ConnectU/resources/assets/js/plugins/font_family.min.js"></script>
		  <script type="text/javascript" src="/ConnectU/resources/assets/js/plugins/font_size.min.js"></script>
		  <script type="text/javascript" src="/ConnectU/resources/assets/js/plugins/fullscreen.min.js"></script>
		  <script type="text/javascript" src="/ConnectU/resources/assets/js/plugins/image.min.js"></script>
		  <script type="text/javascript" src="/ConnectU/resources/assets/js/plugins/image_manager.min.js"></script>
		  <script type="text/javascript" src="/ConnectU/resources/assets/js/plugins/line_breaker.min.js"></script>
		  <script type="text/javascript" src="/ConnectU/resources/assets/js/plugins/link.min.js"></script>
		  <script type="text/javascript" src="/ConnectU/resources/assets/js/plugins/lists.min.js"></script>
		  <script type="text/javascript" src="/ConnectU/resources/assets/js/plugins/paragraph_style.min.js"></script>
		  <script type="text/javascript" src="/ConnectU/resources/assets/js/plugins/quote.min.js"></script>
		  <script type="text/javascript" src="/ConnectU/resources/assets/js/plugins/table.min.js"></script>
		  <script type="text/javascript" src="/ConnectU/resources/assets/js/plugins/save.min.js"></script>
		  <script type="text/javascript" src="/ConnectU/resources/assets/js/plugins/url.min.js"></script>
		  <script type="text/javascript" src="/ConnectU/resources/assets/js/plugins/video.min.js"></script>

		  <!-- Include Language file if we'll use it. -->
		  <script type="text/javascript" src="/ConnectU/resources/assets/js/languages/ro.js"></script>

		  <script>
		      $(function () {
				  $('#froala-editor').froalaEditor();
			  });
		  </script>
	</body>
</html>
