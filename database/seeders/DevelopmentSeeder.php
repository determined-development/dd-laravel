<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DevelopmentSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call(DatabaseSeeder::class);
        $this->call(Development\UserSeeder::class);
    }
}
