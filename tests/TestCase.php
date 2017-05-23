<?php
namespace Yish\Generators\Tests;

use Orchestra\Testbench\TestCase as LaravelTestCase;

class TestCase extends LaravelTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->loadMigrationsFrom([
            '--database' => 'testing',
            '--realpath' => realpath(__DIR__.'/../migrations'),
        ]);

        $this->withFactories(__DIR__.'/factories');
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['path.base'] = __DIR__.'/../src';
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            \Yish\Generators\GeneratorsServiceProvider::class,
            \Orchestra\Database\ConsoleServiceProvider::class,
        ];
    }
}