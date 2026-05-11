<?php

arch('models are eloquent models')
    ->expect('App\Models')
    ->toBeClasses()
    ->toExtend(\Illuminate\Database\Eloquent\Model::class)
    ->ignoring(['App\Models\Scopes', 'App\Models\Concerns', 'App\Models\Contracts']);

arch('scopes are eloquent scopes')
    ->expect('App\Models\Scopes')
    ->toBeClasses()
    ->toExtend(\Illuminate\Database\Eloquent\Scope::class)
    ->toHaveSuffix('Scope');

arch('concerns are eloquent scopes')
    ->expect('App\Models\Concerns')
    ->toBeTraits()
    ->toOnlyBeUsedIn('App\Models');

arch('contracts are interfaces')
    ->expect('App\Models\Contracts')
    ->toByInterfaces();
