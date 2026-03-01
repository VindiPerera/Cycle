<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@cyclecare.lk'],
            [
                'name'     => 'Admin',
                'email'    => 'admin@cyclecare.lk',
                'password' => Hash::make('password'),
            ]
        );

        $this->command->info('✓ Admin user created  →  admin@cyclecare.lk  /  password');
    }
}
