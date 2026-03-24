<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleManager
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        // If they aren't logged in at all, send them to login
        if (!Auth::check()) {
            return redirect('/login');
        }

        // If their role matches what the route requires, let them through!
        if (Auth::user()->role === $role) {
            return $next($request);
        }

        // If a regular user tries to access admin pages (or vice versa), 
        // redirect them back to their own dashboard.
        if (Auth::user()->role === 'admin') {
            return redirect('/admin/dashboard');
        }

        return redirect('/user/dashboard');
    }
}
