<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /** Locales gérées par le site */
    private const SUPPORTED = ['fr', 'en'];

    public function handle(Request $request, Closure $next): Response
    {
        // Premier segment de l'URL : "/" → null, "/en" → "en"
        $segment = $request->segment(1);

        $locale = in_array($segment, self::SUPPORTED, true) ? $segment : 'fr';

        app()->setLocale($locale);

        return $next($request);
    }
}
