<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ValidateTokenRequest;
use App\Services\JwtService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ValidateTokenController extends Controller
{
    public function __construct(
        private readonly JwtService $jwtService
    ) {
    }

    public function __invoke(ValidateTokenRequest $request): JsonResponse
    {
        $token = str_replace('Bearer ', '', $request->access_token);
        $user = $this->jwtService->getUserFromToken($token);

        if (!$user) {
            return response()->json([
                'valid' => false,
                'message' => 'Invalid token',
            ], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json([
            'valid' => true,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
        ]);
    }
}
