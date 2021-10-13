<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        // Remove if not working
        // Check if there is a user
        if (!auth()->user()) {
            abort(403);
        }

        if ($role == 'admin' && !in_array(auth()->user()->role_id, [Role::IS_SUPER_ADMIN, Role::IS_ADMIN])) {
            abort(403);
        }

        if ($role == 'teacher' && auth()->user()->role_id != Role::IS_TEACHER) {
            abort(403);
        }

        if ($role == 'student' && auth()->user()->role_id != Role::IS_STUDENT) {
            abort(403);
        }

        return $next($request);
    }
}
