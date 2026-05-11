<?php

namespace App\Console\Commands\Generators;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputOption;

#[AsCommand(name: 'make:service', description: 'Generates a new service')]
class MakeServiceCommand extends GeneratorCommand
{
    protected $type = 'Service';

    protected function getNameInput(): string
    {
        return str(parent::getNameInput())->finish('Service')->toString();
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Services';
    }

    protected function getOptions(): array
    {
        return [
            ['with-facade', 'w', InputOption::VALUE_NONE, 'Add a facade for the service'],
            ['force', 'f', InputOption::VALUE_NONE, 'Create the service even if the file already exists'],
        ];
    }

    protected function getStub(): string
    {
        return $this->laravel->basePath('stubs/service.stub');
    }

    /**
     * @return bool|null
     */
    public function handle()
    {
        if (parent::handle() === false) {
            return false;
        }

        if ($this->option('with-facade')) {
            $this->call('make:facade', [
                'name' => str($this->getNameInput())->beforeLast('Service')->toString(),
                'target' => $this->getNameInput(),
                'accessor' => $this->getNameInput(),
            ]);
        }
    }
}