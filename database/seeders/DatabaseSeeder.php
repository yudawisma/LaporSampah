<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed akun administrator.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@laporsampah.test'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('AdminLaporSampah2026!'),
                'role' => 'admin',
            ]
        );
    }
}
