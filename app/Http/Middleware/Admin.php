<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Создаем новый middleware
 * php artisan make:middleware Admin
 */
class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        /** проверяем является ли пользователь администратором или нет */
        if (\Auth::user()->is_admin === false) {
            abort(404);
        }

        return $next($request);
    }
}
