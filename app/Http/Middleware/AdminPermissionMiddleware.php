<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminPermissionMiddleware
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

        $admin = $request->admin;

        if (!$admin) {
            abort(403, 'عدم دسترسی');
        }
        if (
            empty($admin->hasPermission($permission)) &&
            !$admin->isSuperAdmin()
        ) {
            abort(403, 'عدم دسترسی');
        }

        return $next($request);
    }
}
