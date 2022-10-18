<?php

namespace App\Http\Middleware;

use App\Models\Member;
use Closure;
use Illuminate\Http\Request;

class MemberPermissionMiddleware
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
        $office_id = $request->route()->parameter('office');

        if (!$permission) {
            abort(403, 'عدم دسترسی');
        }

        $member = $request->current_member;

        if (!$member) {
            abort(403, 'عدم دسترسی');
        }

        if (
            empty($member->hasPermission($permission, $office_id)) &&
            empty($member->isSuperAdmin($office_id))
        ) {
            abort(403, 'عدم دسترسی');
        }

        return $next($request);
    }
}
