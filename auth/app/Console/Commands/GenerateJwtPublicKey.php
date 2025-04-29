<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use OpenSSLAsymmetricKey;

class GenerateJwtPublicKey extends Command
{
    protected $signature = 'jwt:public-key';
    protected $description = 'Generate public key from JWT private key';

    public function handle(): int
    {
        $privateKey = config('jwt.key');

        if (!$privateKey) {
            $this->error('JWT private key not found in configuration');
            return self::FAILURE;
        }

        // Create OpenSSL resource from private key
        $privateKeyResource = openssl_pkey_get_private($privateKey);

        if (!$privateKeyResource) {
            $this->error('Invalid private key format');
            return self::FAILURE;
        }

        // Get public key details
        $publicKeyDetails = openssl_pkey_get_details($privateKeyResource);

        if (!$publicKeyDetails) {
            $this->error('Failed to get public key details');
            return self::FAILURE;
        }

        $publicKey = $publicKeyDetails['key'];

        $this->info('Public Key:');
        $this->line($publicKey);
        $this->newLine();
        $this->info('Copy this key and add it to your .env file as JWT_PUBLIC_KEY');

        return self::SUCCESS;
    }
}
