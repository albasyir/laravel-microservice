<?php

declare(strict_types=1);

namespace App\Services;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Models\User;
use Exception;

class JwtService
{
    private readonly string $privateKey;
    private readonly string $publicKey;
    private readonly string $algorithm;
    private readonly int $expiration;

    public function __construct()
    {
        $this->privateKey = config('jwt.key');
        $this->publicKey = config('jwt.public_key');
        $this->algorithm = config('jwt.algorithm', 'RS256');
        $this->expiration = config('jwt.expiration', 3600);

        if (!$this->privateKey || !$this->publicKey) {
            throw new \RuntimeException('JWT keys are not properly configured');
        }
    }

    public function sign(User $user): string
    {
        $payload = [
            'iss' => config('app.url'),
            'sub' => $user->id,
            'iat' => time(),
            'exp' => time() + $this->expiration,
            'user' => [
                'id' => $user->id,
                'email' => $user->email,
            ]
        ];

        return JWT::encode($payload, $this->privateKey, $this->algorithm);
    }

    public function verify(string $token): array
    {
        try {
            $decoded = JWT::decode($token, new Key($this->publicKey, $this->algorithm));
            return [
                'valid' => true,
                'payload' => (array) $decoded
            ];
        } catch (Exception $e) {
            return [
                'valid' => false,
                'message' => 'Invalid token'
            ];
        }
    }

    public function getUserFromToken(string $token): ?User
    {
        $result = $this->verify($token);

        if (!$result['valid']) {
            return null;
        }

        return User::find($result['payload']['sub']);
    }
}
