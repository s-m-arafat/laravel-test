<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HospitalMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $role = $request->user()->role;


        if ($role == 'hospital_owner') {

            return $next($request);
        }

        // User does not have 'hospitalowner' role, or for any other condition.
        return response()->json(['message' => 'You do not have permission to access this page.'], 403);
    }
}
