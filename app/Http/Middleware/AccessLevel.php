<?php

namespace App\Http\Middleware;

use Closure;

class AccessLevelMiddleware
{
    public function handle($request, Closure $next, $requiredLevel)
    {
        $user = $request->user();
        // echo "requiredLevel: " . $requiredLevel;
        // echo "\nuserAccessLevel: " . $user->accessLevel->id;

        $result =  response()->json(['error' => 'Unauthorized access.'], 403);
        
        if ($user && $user->accessLevel->id <= $requiredLevel) {
            $result = $next($request);
        }

        return $result;
    }
}
