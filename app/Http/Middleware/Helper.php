<?php

namespace ConnectU\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Contracts\Auth\Guard;

class Helper
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        # Checks to see if the current user is staff
        if (!Auth::user()->position) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                # Return ack if the user is not staff
                return redirect()->back()->with('info', 'You are not allowed to view that page!');
            }
        }

        return $next($request);
    }
}
