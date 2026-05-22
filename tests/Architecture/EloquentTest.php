<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

arch('models are eloquent models')
    ->expect('App\Models')
    ->toBeClasses()
    ->ignoring(['App\Models\Attributes', 'App\Models\Scopes', 'App\Models\Concerns', 'App\Models\Contracts'])
    ->toExtend(Model::class)
    ->ignoring(['App\Models\Attributes', 'App\Models\Scopes', 'App\Models\Concerns', 'App\Models\Contracts']);

arch('attributes are attribute classes')
    ->expect('App\Models\Attributes')
    ->toBeClasses()
    ->toHaveAttribute(Attribute::class)
    ->toOnlyBeUsedIn('App\Models');

arch('scopes are eloquent scopes')
    ->expect('App\Models\Scopes')
    ->toBeClasses()
    ->toExtend(Scope::class)
    ->toHaveSuffix('Scope');

arch('concerns are traits')
    ->expect('App\Models\Concerns')
    ->toBeTraits()
    ->toOnlyBeUsedIn('App\Models');

arch('contracts are interfaces')
    ->expect('App\Models\Contracts')
    ->toBeInterfaces();
