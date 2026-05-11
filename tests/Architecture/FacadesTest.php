<?php

arch('facades namespace contains facades')
    ->expect('App\Support\Facades')
    ->toBeClasses()
    ->toExtend(Illuminate\Support\Facades\Facade::class);
