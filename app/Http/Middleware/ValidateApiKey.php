<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateApiKey
{
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->header('X-API-Key');

        if (!$apiKey) {
            return response()->json(['message' => 'API key is missing'], 401);
        }

        if ($apiKey !== config('services.api.key')) {
            return response()->json(['message' => 'Invalid API key'], 403);
        }

        return $next($request);
    }
} 