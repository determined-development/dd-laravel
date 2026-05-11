<?php

arch('seeder classes are seeders')
    ->expect('Database\Seeders')
    ->toBeClasses()
    ->toExtend(\Illuminate\Database\Seeder::class)
    ->toHaveSuffix('Seeder');

arch('factory classes are factories')
    ->expect('Database\Factories')
    ->toBeClasses()
    ->toExtend(\Illuminate\Database\Eloquent\Factories\Factory::class)
    ->toHaveSuffix('Factory');
