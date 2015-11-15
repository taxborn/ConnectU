@extends('templates.default')

@section('title')
	Home
@stop

@section('content')
	<h3 style="text-align: center;">Welcome to ConnectU</h3>
	<br>
	<div class="parallax-container">
		<div class="parallax">
			<img src="http://wallpapers.wallhaven.cc/wallpapers/full/wallhaven-118264.png" alt="Grunge Nature" />
		</div>
	</div>
	<div class="row">
		<br>
		<div class="col s4 center">
			<i class="material-icons" style="font-size: 60px;">flash_on</i><br>
			<strong>Powerful and Light</strong>
			<p>
				ConnectU is a powerful tool to "ConnectU" to other people. Just try us out and it will be sure to amaze you.
			</p>
		</div>
		<div class="col s4 center">
			<i class="material-icons" style="font-size: 60px;">code</i><br>
			<strong>Constantly Updated</strong>
			<p>
				ConnectU is updated. Always. We do bi-weekly updates so you are sure to be on the bleeding edge of social networking!
			</p>
		</div>
		<div class="col s4 center">
			<i class="material-icons" style="font-size: 60px;">chat_bubble</i><br>
			<strong>Here to Listen</strong>
			<p>
				Have a question? Think you can make ConnectU better? Email us at: <a href="mailto:help@connectu.xyz">help@connectu.xyz</a> with anything that you may need.
			</p>
		</div>
	</div>
	<div class="parallax-container">
		<div class="parallax">
			<img src="http://i.imgur.com/ijZB0ry.jpg" alt="Railroad" />
		</div>
	</div>
	<div class="row">
		<br>
		<div class="col s6 center">
			<i class="material-icons" style="font-size: 60px;">create</i><br>
			<strong>Contribute to ConnectU</strong>
			<p>
				ConnectU is fully open-source. This means that the code behind ConnectU is directly available for anyone to use or to extend! Head over to the <a href="https://www.github.com/BraxtonFair/ConnectU" target="_blank">GitHub Repository</a> to see the code!
			</p>
		</div>
		<div class="col s6 center">
			<i class="material-icons" style="font-size: 60px;">account_circle</i><br>
			<strong>Join the Team</strong>
			<p>
				ConnectU is a project that will eventually need more brain power to function. If you want to become apart of the ConnectU Team, just comment on the issue <a href="https://github.com/BraxtonFair/ConnectU/issues/1" target="_blank">here</a> and fill out the form!
			</p>
		</div>
	</div>
@stop
