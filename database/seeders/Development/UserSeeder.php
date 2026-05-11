<?php

namespace Database\Seeders\Development;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::query()
            ->where('email', 'super@example.com')
            ->first() ?? User::factory()->make(['email', 'super@example.com']);

        $user->password = Hash::make('password');

        $user->save();
    }
}
