<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
class PharmacienMiddleware
{
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->role === 'pharmacien') {
            return $next($request);
        }

        return redirect()->route('login')->with('error', 'Accès réservé aux pharmaciens.');
    }
}
