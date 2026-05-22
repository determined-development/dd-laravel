<?php

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Seeder;

arch('seeder classes are seeders')
    ->expect('Database\Seeders')
    ->toBeClasses()
    ->toExtend(Seeder::class)
    ->toHaveSuffix('Seeder');

arch('factory classes are factories')
    ->expect('Database\Factories')
    ->toBeClasses()
    ->toExtend(Factory::class)
    ->toHaveSuffix('Factory');
