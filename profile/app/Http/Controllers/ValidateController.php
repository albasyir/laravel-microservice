<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): JsonResponse
    {
        try {
            $jwtPayload = $request->attributes->get('jwt_payload');

            if (!$jwtPayload) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'JWT payload not found'
                ], Response::HTTP_UNAUTHORIZED);
            }

            return response()->json([
                'status' => 'success',
                'data' => $jwtPayload
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while validating the token'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
