<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{

    public function handle($request, $next)
    {
        app()->setLocale(session('locale', config('app.locale')));
        return $next($request);
    }
}
