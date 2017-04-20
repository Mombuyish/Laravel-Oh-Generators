<?php

namespace Yish\Generators\Commands;

use Illuminate\Console\GeneratorCommand;

class TransformMakeCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:transform';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new transform class';

    protected $type = 'Transform';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/../stubs/transform.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Transforms';
    }
}
