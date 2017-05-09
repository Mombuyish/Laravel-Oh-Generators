<?php

namespace Yish\Generators;

use Illuminate\Support\ServiceProvider;
use Yish\Generators\Commands\FormatterMakeCommand;
use Yish\Generators\Commands\PresenterMakeCommand;
use Yish\Generators\Commands\RepositoryMakeCommand;
use Yish\Generators\Commands\ServiceMakeCommand;
use Yish\Generators\Commands\TransformerMakeCommand;
use Yish\Generators\Commands\ValidatorMakeCommand;

class GeneratorsServiceProvider extends ServiceProvider
{
    protected $commands = [
        //
    ];

    /**
     * The commands to be registered.
     *
     * @var array
     */
    protected $devCommands = [
        'ServiceMake' => 'command.service.make',
        'RepositoryMake' => 'command.repository.make',
        'TransformerMake' => 'command.transformer.make',
        'PresenterMake' => 'command.presenter.make',
        'ValidatorMake' => 'command.validator.make',
        'FormatterMake' => 'command.formatter.make',
    ];

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerCommands(array_merge(
            $this->commands, $this->devCommands
        ));
    }

    /**
     * Register the given commands.
     *
     * @param  array $commands
     * @return void
     */
    protected function registerCommands(array $commands)
    {
        foreach (array_keys($commands) as $command) {
            call_user_func_array([$this, "register{$command}Command"], []);
        }

        $this->commands(array_values($commands));
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerServiceMakeCommand()
    {
        $this->app->singleton('command.service.make', function ($app) {
            return new ServiceMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerRepositoryMakeCommand()
    {
        $this->app->singleton('command.repository.make', function ($app) {
            return new RepositoryMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerTransformerMakeCommand()
    {
        $this->app->singleton('command.transformer.make', function ($app) {
            return new TransformerMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerPresenterMakeCommand()
    {
        $this->app->singleton('command.presenter.make', function ($app) {
            return new PresenterMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerValidatorMakeCommand()
    {
        $this->app->singleton('command.validator.make', function ($app) {
            return new ValidatorMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerFormatterMakeCommand()
    {
        $this->app->singleton('command.formatter.make', function ($app) {
            return new FormatterMakeCommand($app['files']);
        });
    }
}
