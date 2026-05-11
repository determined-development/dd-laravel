<?php

arch('enums namespace contains enums')
    ->expect('App\Enums')
    ->toBeEnums()
    ->ignoring(['App\Enums\Meta', 'App\Enums\Concerns']);

arch('enum meta properties are meta properties')
    ->expect('App\Enums\Meta')
    ->toBeClasses()
    ->toExtend(\ArchTech\Enums\Meta\MetaProperty::class)
    ->toHaveAttribute(\Attribute::class)
    ->toOnlyBeUsedIn('App\Enums\*');

arch('enum concerns includes traits only')
    ->expect('App\Enums\Concerns')
    ->toBeTraits()
    ->toOnlyBeUsedIn('App\Enums\*');
