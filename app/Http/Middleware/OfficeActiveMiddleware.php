<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class OfficeActiveMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $office = $request->route()->parameter('office');

        if (!$office->isVerified()) {
            return redirect(route('office_not_active', $office->id));
        }

        return $next($request);
    }
}
