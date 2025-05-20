<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleBasedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$roles  Roles that are allowed to access the route
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = Auth::user();

        if (!$user || !in_array($user->role, $roles)) {
            // Optional: Redirect based on user role if needed
            return redirect()->route($this->redirectTo($user));
        }

        return $next($request);
    }

    protected function redirectTo($user)
    {
        // Default redirect if user role not allowed
        return match ($user->role ?? null) {
            'admin' => 'admin.dashboard',
            'lecturer' => 'lecturer.dashboard',
            'student' => 'student.dashboard',
            'staff' => 'staff.dashboard',
            'technician' => 'technician.dashboard',
            default => 'login',
        };
    }
}
