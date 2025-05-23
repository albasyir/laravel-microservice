<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Aziz',
            'email' => 'aziz@shariacoin.com',
            'password' => Hash::make('aziz123'),
        ]);
    }
}
