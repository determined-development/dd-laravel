<?php

use Illuminate\Support\Facades\Facade;

arch('facades namespace contains facades')
    ->expect('App\Support\Facades')
    ->toBeClasses()
    ->toExtend(Facade::class);
