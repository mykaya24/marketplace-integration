<?php


namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class IntegrationUserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'integration@internal.local'],
            [
                'name' => 'Integration Service',
                'password' => Hash::make(Str::random(40)),
            ]
        );
    }
}
