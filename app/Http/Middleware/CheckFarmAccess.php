<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckFarmAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        $farmId = $request->route('farm') ? $request->route('farm')->id : $request->farm_id;

        if (!$farmId) {
            return response()->json(['message' => 'Farm ID not provided'], 400);
        }

        if (!auth()->user()->farms->contains($farmId)) {
            return response()->json(['message' => 'Unauthorized access to this farm'], 403);
        }

        return $next($request);
    }
} 