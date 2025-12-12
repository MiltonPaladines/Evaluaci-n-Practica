<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user() && $request->user()->role === 'admin') {
            return $next($request); //Siguiente middleware o controlador
        }

        return response()->json([
            'success' => false,
            'message' => 'Acceso denegado. Se requieren privilegios de administrador.'
        ], 403); //403 forbidden si no es admin
    }
}
