<?php

namespace App\Http\Middleware;

use App\Models\ApiToken;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();
        if (ApiToken::where('secret_token', $token)->count() != 1) {
            return responseModel(400, "Invalid credentials", ["errors" => ['credentials' => 'Invalid API Token']]);
        };
        return $next($request);
    }
}
