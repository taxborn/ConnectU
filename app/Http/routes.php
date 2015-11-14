<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

# Home Route as home
Route::get('/', [
	'uses' => '\ConnectU\Http\Controllers\HomeController@index',
	'as'   => 'home',
]);

Route::get('/notify', function () {
	notify()->flash('You have signed in', 'success');

	return redirect()->back();
});

# Handles the /public route not being allowed as public
Route::get('/public', [
	'uses' => '\ConnectU\Http\Controllers\HomeController@publicHandler',
	'as'   => 'public',
]);

# User Guidelines route as guidelines
Route::get('/guidelines', [
	'uses' => '\ConnectU\Http\Controllers\HomeController@guide',
	'as'   => 'guidelines',
]);

# Database metrics route as metrics
Route::get('/metrics', [
	'uses' => '\ConnectU\Http\Controllers\DashboardController@metrics',
	'as'   => 'metrics',
]);

# Authentication route group
Route::group(['middleware' => ['guest']], function() {
    # GET Signup route as auth.signup
	Route::get('/signup', [
		'uses' => '\ConnectU\Http\Controllers\AuthController@getSignup',
		'as'   => 'auth.signup',
	]);

    # POST Signup route
	Route::post('/signup', [
		'uses' => '\ConnectU\Http\Controllers\AuthController@postSignup',
	]);

    # GET Signin route as auth.signin
	Route::get('/signin', [
		'uses' => '\ConnectU\Http\Controllers\AuthController@getSignin',
		'as'   => 'auth.signin',
	]);

    # POST Signin route
	Route::post('/signin', [
		'uses' => '\ConnectU\Http\Controllers\AuthController@postSignin',
	]);
});

# Sometimes, when you've timed out on a request, you'd get redirected to /auth.signin, which should be a route
# This fixes that, by just redirecting you to the signin page
Route::get('/auth.signin', function() {
	return redirect()->route('auth.signin');
});

# Signout route as auth.signout
Route::get('/signout', [
	'uses'       => '\ConnectU\Http\Controllers\AuthController@getSignout',
	'as'         => 'auth.signout',
	'middleware' => ['auth'],
]);

# Search route as search.results
Route::get('/search', [
	'uses'       => '\ConnectU\Http\Controllers\SearchController@getResults',
	'as'         => 'search.results',
	'middleware' => ['auth'],
]);

# User profile routes group
Route::group(['middleware' => ['auth']], function() {
    # User profile route as profile.index
	Route::get('@{username}', [
		'uses' => '\ConnectU\Http\Controllers\ProfileController@getProfile',
		'as'   => 'profile.index',
	]);

    # GET User edit profile route as profile.edit
	Route::get('@{username}/edit', [
		'uses' => '\ConnectU\Http\Controllers\ProfileController@getEdit',
		'as'   => 'profile.edit',
	]);

    # POST User edit profile route
	Route::post('@{username}/edit', [
		'uses' => '\ConnectU\Http\Controllers\ProfileController@postEdit',
	]);

    # GET User edit password route as profile.password
	Route::get('@{username}/password', [
		'uses' => '\ConnectU\Http\Controllers\ProfileController@getEditPassword',
		'as'   => 'profile.password',
	]);

    # POST User edit password route
	Route::post('@{username}/password', [
		'uses' => '\ConnectU\Http\Controllers\ProfileController@postEditPassword',
	]);

    # GET User delete account as profile.delete
	Route::get('@{username}/delete', [
		'uses' => '\ConnectU\Http\Controllers\ProfileController@getDelete',
		'as'   => 'profile.delete',
	]);

    # POST User delete account
	Route::post('@{username}/delete', [
		'uses' => '\ConnectU\Http\Controllers\ProfileController@postDelete',
	]);
});

# Friend route group
Route::group(['middleware' => ['auth']], function() {
    # Friends main route as friends.index
	Route::get('/friends', [
		'uses' => '\ConnectU\Http\Controllers\FriendController@getIndex',
		'as'   => 'friends.index',
	]);

    # Add friends route as friends.add
	Route::get('/friend/{username}/add', [
		'uses' => '\ConnectU\Http\Controllers\FriendController@getAdd',
		'as'   => 'friends.add',
	]);

    # Accept Friend request route as friends.accept
	Route::get('/friend/{username}/accept', [
		'uses' => '\ConnectU\Http\Controllers\FriendController@getAccept',
		'as'   => 'friends.accept',
	]);

    # Remove friend route as friends.remove
	Route::get('/friend/{username}/remove', [
		'uses' => '\ConnectU\Http\Controllers\FriendController@getRemove',
		'as'   => 'friends.remove',
	]);
});

# Statuses
Route::group(['middleware' => ['auth']], function() {
    # POST status route as status.post
	Route::post('/status', [
		'uses' => '\ConnectU\Http\Controllers\StatusController@postStatus',
		'as'   => 'status.post',
	]);

    # POST reply status route as status.reply
	Route::post('/status/{statusId}/reply', [
		'uses' => '\ConnectU\Http\Controllers\StatusController@postReply',
		'as'   => 'status.reply',
	]);

    # Status like route as status.like
	Route::get('/status/{statusId}/like', [
		'uses' => '\ConnectU\Http\Controllers\StatusController@getLike',
		'as'   => 'status.like',
	]);

    # Delete status route as status.delete
	Route::get('/status/{statusId}/delete', [
		'uses' => '\ConnectU\Http\Controllers\StatusController@getDelete',
		'as'   => 'status.delete',
	]);

    # GET Edit status as status.edit
	Route::get('/status/{statusId}/edit', [
		'uses' => '\ConnectU\Http\Controllers\StatusController@getEdit',
		'as'   => 'status.edit',
	]);

    # POST Edit status
	Route::post('/status/{statusId}/edit', [
		'uses' => '\ConnectU\Http\Controllers\StatusController@postEdit',
	]);
});

# Administrator Dashboard
Route::group(['middleware' => ['admin']], function() {
    # Main Administrator dashboard as admin.home
	Route::get('/dashboard', [
		'uses' => '\ConnectU\Http\Controllers\DashboardController@index',
		'as'   => 'admin.home',
	]);

    # Delete user as admin.delete.user
	Route::get('/dashboard/@{username}/delete', [
		'uses' => '\ConnectU\Http\Controllers\DashboardController@deleteUser',
		'as'   => 'admin.delete.user',
	]);

    # GET Edit user as admin.edituser
	Route::get('/dashboard/@{username}/edit', [
		'uses' => '\ConnectU\Http\Controllers\DashboardController@getEditUser',
		'as'   => 'admin.edituser',
	]);

    # POST Edit user
	Route::post('/dashboard/@{username}/edit', [
		'uses' => '\ConnectU\Http\Controllers\DashboardController@postEditUser',
	]);

    # User logs as admin.userlogs
	Route::get('/dashboard/@{username}/logs', [
		'uses' => '\ConnectU\Http\Controllers\DashboardController@userlogs',
		'as'   => 'admin.userlogs',
	]);

    # GET Change user password as admin.userpassword
	Route::get('/dashboard/@{username}/password', [
		'uses' => '\ConnectU\Http\Controllers\DashboardController@getEditUserPassword',
		'as'   => 'admin.userpassword',
	]);

    # POST Change user password
	Route::post('/dashboard/@{username}/password', [
		'uses' => '\ConnectU\Http\Controllers\DashboardController@postEditUserPassword',
	]);

    # Delete status as admin.deletepost
	Route::get('/dashboard/{postId}/delete', [
		'uses' => '\ConnectU\Http\Controllers\DashboardController@deletePost',
		'as'   => 'admin.deletepost',
	]);

    # Promote user as admin.promote
	Route::get('/dashboard/{userId}/promote', [
		'uses' => '\ConnectU\Http\Controllers\DashboardController@promoteUser',
		'as'   => 'admin.promote',
	]);

    # Demote user as admin.demote
	Route::get('/dashboard/{userId}/demote', [
		'uses' => '\ConnectU\Http\Controllers\DashboardController@demoteUser',
		'as'   => 'admin.demote',
	]);
});

# Moderator Dashboard
Route::group(['middleware' => ['moderator']], function () {
    # Moderator main dashboard as moderator.home
	Route::get('/moderator', [
		'uses' => '\ConnectU\Http\Controllers\ModeratorController@home',
		'as'   => 'moderator.home',
	]);
});

# Helper Dashboard
Route::group(['middleware' => ['helper']], function () {
    # Helper main dashboard as helper.home
	Route::get('/helper', [
		'uses' => '\ConnectU\Http\Controllers\HelperController@home',
		'as'   => 'helper.home'
	]);
});
