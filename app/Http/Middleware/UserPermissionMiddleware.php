<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserPermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$permission)
    {
        if (!$permission) {
            abort(403, 'عدم دسترسی');
        }

        $user = $request->current_user;

        if (!$user) {
            abort(403, 'عدم دسترسی');
        }

        if (
            empty($user->hasPermission($permission))
        ) {
            abort(403, 'عدم دسترسی');
        }

        return $next($request);
    }
}
