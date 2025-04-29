<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreIdentityRequest;
use App\Models\Identity;
use Illuminate\Http\JsonResponse;

class IdentityController extends Controller
{
    public function __invoke(StoreIdentityRequest $request): JsonResponse
    {
        $identity = Identity::create([
            'profile_id' => $request->validated('profile_id'),
            'identity_id' => $request->validated('identity_id'),
            'identity_photo' => $request->validated('identity_photo'),
            'address' => $request->validated('address'),
            'acks' => [],
        ]);

        return response()->json([
            'message' => 'Identity created successfully',
            'data' => $identity,
        ], 201);
    }
}