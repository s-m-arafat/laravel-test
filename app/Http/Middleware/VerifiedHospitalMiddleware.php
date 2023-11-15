<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifiedHospitalMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $isVerified = $request->user()->verified;
        // var_dump($isVerified);
        if ($isVerified == "true") {
            return $next($request);
        }
        else return response()->json(['message' => 'You are not verified yet'], 401);
    }
}
