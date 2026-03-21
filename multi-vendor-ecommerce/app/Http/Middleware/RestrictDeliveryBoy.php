<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RestrictDeliveryBoy
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->isDeliveryBoy()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false, 
                    'message' => 'Delivery accounts cannot make purchases or access the customer dashboard.'
                ], 403);
            }
            return redirect()->route('delivery.dashboard')->with('error', 'Delivery accounts cannot access the customer dashboard.');
        }

        return $next($request);
    }
}
