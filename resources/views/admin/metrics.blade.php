<?php
use Carbon\Carbon;

$project_start = Carbon::createFromDate(2015, 12, 15);
$current_time = Carbon::now();

$difference = $project_start->diffInDays($current_time);

?>
@extends('templates.default')

@section('title')
	Metrics
@stop

@section('content')
	<div class="container">
		<h3>Metrics</h3>
		<p>There are {{ DB::table('users')->count() }} users in the database.</p>
		<p>There are {{ DB::table('statuses')->whereNull('parent_id')->count() }} statuses in the database.</p>
		<p>There are {{ DB::table('statuses')->whereNotNull('parent_id')->count() }} replies in the database.</p>
		<p>There are {{ DB::table('friends')->count() }} friendships in the database.</p>
		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;There are {{ DB::table('friends')->where('accepted', false)->count() }} friend requests</p>
		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;There are {{ DB::table('friends')->where('accepted', true)->count() }} friendships</p>
		<p>
			ConnectU has been running since December 15th, 2015, so for {{ $difference }} days!.
		</p>
	</div>
	<br>
	<br>
	
@stop
