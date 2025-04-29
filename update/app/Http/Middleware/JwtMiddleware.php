<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;
use RuntimeException;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        if (!$token) {
            return $this->unauthorizedResponse('Token not provided');
        }

        try {
            $publicKey = env('JWT_PUBLIC_KEY');
            if (!$publicKey) {
                throw new RuntimeException('JWT public key is not configured');
            }

            $decoded = JWT::decode($token, new Key($publicKey, 'RS256'));

            // Convert stdClass to array and add to request attributes
            $request->attributes->add(['jwt_payload' => json_decode(json_encode($decoded), true)]);

            return $next($request);
        } catch (Exception $e) {
            return $this->unauthorizedResponse('Invalid token');
        }
    }

    /**
     * Return an unauthorized response with the given message.
     */
    private function unauthorizedResponse(string $message): Response
    {
        return response()->json([
            'status' => 'error',
            'message' => $message
        ], Response::HTTP_UNAUTHORIZED);
    }
}
