<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FilamentRoleMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // dd(auth()->user());
      if (!auth()->check()) {
    return redirect()->route('filament.admin.auth.login');
        }
     if (!in_array(auth()->user()->role, ['student', 'teacher'])) {
            abort(403);
        }

        return $next($request);
    }
}
