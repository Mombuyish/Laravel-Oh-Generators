<?php

namespace Yish\Generators\Commands;

use Illuminate\Console\GeneratorCommand;

class ParserMakeCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:parser';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new parser class';

    protected $type = 'Parser';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/../stubs/parser.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Parsers';
    }
}
