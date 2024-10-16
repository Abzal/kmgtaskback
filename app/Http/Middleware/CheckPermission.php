<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    public function handle(Request $request, Closure $next, $permission)
    {
        if (!Auth::user() || !Auth::user()->can($permission)) {
            return response()->json(['message' => 'Недостаточно прав'], 403);
        }

        return $next($request);
    }
}
