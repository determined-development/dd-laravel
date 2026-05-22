<?php

arch('policies are classes')
    ->expect('App\Policies')
    ->toBeClasses()
    ->ignoring(['App\Policies\Concerns']);

arch('policies are named correctly')
    ->expect('App\Policies')
    ->toHaveSuffix('Policy')
    ->ignoring(['App\Policies\Concerns']);

arch('concerns are traits')
    ->expect('App\Policies\Concerns')
    ->toBeTraits()
    ->toOnlyBeUsedIn('App\Policies');
