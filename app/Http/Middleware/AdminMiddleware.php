<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if ($request->user() && $request->user()->role === 'admin') {
            return $next($request); // Lanjutkan permintaan jika pengguna adalah admin
        }
    
        // Jika tidak, Anda bisa mengarahkan mereka ke halaman lain atau memberikan respons lainnya
        return redirect('/')->with('error', 'Unauthorized access'); // Misalnya, arahkan ke halaman beranda dengan pesan error
    }
    
}
