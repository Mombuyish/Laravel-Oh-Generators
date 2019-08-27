<?php

namespace Yish\Generators\Commands;

use Illuminate\Console\GeneratorCommand;

class TransportMakeCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:transport';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new transport class';

    protected $type = 'Transport';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/../stubs/transport.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Transports';
    }
}
