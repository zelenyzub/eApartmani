<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next)
    {
        // dd($request->session()->get('user')->role);

        $userRole = $request->session()->get('user')->role;
        if ($userRole !== 'SUPERADMIN') {
            return redirect('/kalendar');
        }
        return $next($request);

    }
}
