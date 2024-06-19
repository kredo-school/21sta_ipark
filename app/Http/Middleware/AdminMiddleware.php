<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; //use for authentication
use App\Models\User;                //represents the users table

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /**
         * The Auth::check() will return "true" if the user is logged-in
         * If the Auth::check() is true, and the role_id is == 1
         * then the user can access the admin dashboard (We will see this later on
         * in the web.php)
         */


            if (auth()->user() && auth()->user()->role_id == 1) { // assuming role_id 1 is admin
                return $next($request);
            }
            return redirect('/home');

    }
}
