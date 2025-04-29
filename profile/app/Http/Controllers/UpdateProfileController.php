<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\Profile;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UpdateProfileController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateProfileRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $userId = $request->attributes->get('jwt_payload')['sub'];

        $profile = Profile::updateOrCreate(
            ['user_id' => $userId],
            array_merge($validated, ['user_id' => $userId])
        );

        return response()->json([
            'status' => 'success',
            'data' => $profile
        ], Response::HTTP_CREATED);
    }
}
