@extends('templates.default')

@section('title')
	Metrics
@stop

@section('content')
	<h3>Metrics</h3>
	<p>There are {{ DB::table('users')->count() }} users in the database.</p>
	<p>There are {{ DB::table('statuses')->whereNull('parent_id')->count() }} statuses in the database.</p>
	<p>There are {{ DB::table('statuses')->whereNotNull('parent_id')->count() }} replies in the database.</p>
	<p>There are {{ DB::table('friends')->count() }} friendships in the database.</p>
	<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;There are {{ DB::table('friends')->where('accepted', false)->count() }} friend requests</p>
	<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;There are {{ DB::table('friends')->where('accepted', true)->count() }} friendships</p>
@stop