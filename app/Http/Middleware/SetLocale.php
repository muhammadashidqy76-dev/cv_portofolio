<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     * Reads the 'locale' key from the session and sets the application locale.
     * Falls back to the default locale defined in config/app.php.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $supported = ['id', 'en'];

        $locale = session('locale', config('app.locale'));

        if (! in_array($locale, $supported)) {
            $locale = config('app.locale');
        }

        app()->setLocale($locale);

        return $next($request);
    }
}
