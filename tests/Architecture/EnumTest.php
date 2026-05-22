<?php

use ArchTech\Enums\Meta\MetaProperty;

arch('enums namespace contains enums')
    ->expect('App\Enums')
    ->toBeEnums()
    ->ignoring(['App\Enums\Meta', 'App\Enums\Concerns']);

arch('enum meta properties are meta properties')
    ->expect('App\Enums\Meta')
    ->toBeClasses()
    ->toExtend(MetaProperty::class)
    ->toHaveAttribute(Attribute::class);

arch('enum meta properties are only used on enums')
    ->expect('App\Enums\Meta')
    ->toBeClasses()
    ->toOnlyBeUsedIn('App\Enums');

arch('enum concerns includes traits only')
    ->expect('App\Enums\Concerns')
    ->toBeTraits()
    ->toOnlyBeUsedIn('App\Enums');
