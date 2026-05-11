<?php

arch('controllers namespace extend base controller')
    ->expect('App\Http\Controllers')
    ->toBeClasses()
    ->toExtend(\App\Http\Controllers\Controller::class);

arch('requests namespace extend form request')
    ->expect('App\Http\Requests')
    ->toBeClasses()
    ->toExtend(\Illuminate\Foundation\Http\FormRequest::class);
