<?php

namespace App\Console\Commands\Generators;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputOption;

#[AsCommand(name: 'make:facade', description: 'Generates a new facade')]
class MakeFacadeCommand extends GeneratorCommand
{
    protected $type = 'Facade';

    protected string $accessor;
    protected string $target;

    protected function buildClass($name): string
    {
        $dummyTarget = '\Dummy\Target';
        $dummyMixin = 'Target';

        $replace = $this->buildFacadeReplacements(
            [],
            $dummyTarget,
            $name,
        );

        return str_replace(
            [
                'use ' . $dummyTarget . ';' . PHP_EOL,
                $dummyMixin . '::class',
                PHP_EOL . '/**' . PHP_EOL . ' * @mixin ' . $dummyMixin  . PHP_EOL . ' */'
            ],
            ['', ''],
            str_replace(
                array_keys($replace),
                array_values($replace),
                parent::buildClass($name)
            )
        );
    }

    protected function buildFacadeReplacements(
        array $replace,
        string $dummyTarget,
        string $name,
    ): array {
        $mixin = $this->getTargetClass($name);
        $import = $mixin;
        $target = $this->getServiceAccessor($name);

        // Handle targets with the same name as the facade
        if (class_basename($import) === class_basename($name)) {
            $alias = class_basename($import) . 'Service';
            $import .= ' as ' . $alias;
        } else {
            $alias = class_basename($import);
        }

        $accessor = class_exists($target)
            ? class_basename($target) . '::class'
            : str($target)->wrap('\'')->toString();

        return array_merge($replace, [
            '{{ import }}' => $import,
            '{{import}}' => $import,
            '{{ mixin }}' => $alias,
            '{{mixin}}' => $alias,
            '{{ accessor }}' => $accessor,
            '{{accessor}}' => $accessor,
        ]);
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Support\Facades';
    }

    protected function getServiceAccessor(string $name): string
    {
        return $this->accessor ??= (
            $this->option('accessor')
            ?? array_first(array_filter(array_unique([
                $this->getOption('target') ?? 'DummyTarget',
                'App\\Services\\' . $name . 'Service',
                'App\\Services\\' . class_basename($name) . 'Service',
                'App\\Services\\' . $name,
                'App\\Services\\' . class_basename($name),
                $name . 'Service',
                class_basename($name) . 'Service',
                $name,
                class_basename($name),
            ]), class_exists(...)))
            ?? str($name)->replace('\\', '.')->slug('-')->toString()
        );
    }

    protected function getTargetClass(string $name): string
    {
        $service = $this->getServiceAccessor($name);

        return $this->target ??= (
            $this->option('target') ?? class_exists($service) ? $service : get_class(resolve($service))
        );
    }

    protected function getOptions(): array
    {
        return [
            ['target', 't', InputOption::VALUE_REQUIRED, 'Set the target service class'],
            ['accessor', 'a', InputOption::VALUE_REQUIRED, 'Set the service accessor'],
            ['force', 'f', InputOption::VALUE_NONE, 'Create the facade even if the file already exists'],
        ];
    }

    protected function getStub(): string
    {
        return $this->laravel->basePath('stubs/facade.stub');
    }
}
