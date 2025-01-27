<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Redac
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if ($user && ($user->role === 'admin' || $user->role === 'redac')) {
            return $next($request);
        }

        return redirect()->route('home');
    }
}
