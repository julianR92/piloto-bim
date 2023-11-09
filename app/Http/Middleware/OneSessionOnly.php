<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class OneSessionOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $currentSessionId = session()->getId();

            if ($user->session_id !== $currentSessionId) {
                // El usuario ya tiene una sesión abierta en otro lugar
                Auth::logout();
                return redirect('/login')->with('error', 'Tu sesión anterior ha sido cerrada.');
            }
        }

        return $next($request);
    }
}
