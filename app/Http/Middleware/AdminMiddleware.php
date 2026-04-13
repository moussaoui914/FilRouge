<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
   
    public function handle(Request $request, Closure $next): Response
    {
        /**
         * @var App\Models\User $user
         *  */        
        $user = Auth::user();


        if (!Auth::check() || !$user->isAdmin()) {
            return redirect()->route('home')
                ->with('error', 'Access denied. Admin privileges required.');
        }

        return $next($request);
    }
}