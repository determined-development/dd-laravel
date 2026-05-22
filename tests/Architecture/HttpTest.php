<?php

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Http\FormRequest;

arch('controllers namespace extend base controller')
    ->expect('App\Http\Controllers')
    ->toBeClasses()
    ->toExtend(Controller::class);

arch('requests namespace extend form request')
    ->expect('App\Http\Requests')
    ->toBeClasses()
    ->toExtend(FormRequest::class);
