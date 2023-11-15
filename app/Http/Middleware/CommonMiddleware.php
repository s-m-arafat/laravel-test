<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CommonMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $role = $request->user()->role;
        if ($role == 'user' or $role == 'hospital_owner') {
            return $next($request);
        }

        // send a message and redirect to the home page
        return response()->json(['message' => 'You do not have permission to access this page.'], 403);
    }
}
