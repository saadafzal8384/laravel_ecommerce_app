<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    final public const USER = 0;
    final public const ADMIN_USER = 1;

    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::user()->role_as === self::ADMIN_USER) {
            return redirect('/home')->with('status', 'Access Denied, you are not admin');
        }
        return $next($request);
    }
}
