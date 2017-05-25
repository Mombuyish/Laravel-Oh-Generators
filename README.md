<p align="center"><img src="http://i.imgur.com/VK7ZOr6.png?1"></p>

<p align="center">
<a href="https://travis-ci.org/Mombuyish/Laravel-Oh-Generators"><img src="https://travis-ci.org/Mombuyish/Laravel-Oh-Generators.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/yish/generators"><img src="https://poser.pugx.org/yish/generators/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/yish/generators"><img src="https://poser.pugx.org/yish/generators/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/yish/generators"><img src="https://poser.pugx.org/yish/generators/license.svg" alt="License"></a>
<a href="https://packagist.org/packages/yish/generators"><img src="https://poser.pugx.org/yish/generators/v/unstable.svg" alt="License"></a>
</p>

# Laravel Oh Generators

> This package extends the core file generators that are included with Laravel 5

# Installation

Install by composer
```
    $ composer require yish/generators
```

Registing Service Provider

``` php
<?php

//app.php

'providers' => [
        /*
         * Package Service Providers...
         */
        Laravel\Tinker\TinkerServiceProvider::class,
        
        /*
         * Generator Service Provider
         */
        \Yish\Generators\GeneratorsServiceProvider::class,
        
        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
    ],

```

## Example

Providing commands:

### Generating Service:
> It can be generating class service.

```
    $ php artisan make:service UserService
```

* Supported:
    * [Abstract Service](https://github.com/Mombuyish/Laravel-Oh-Generators/wiki/Abstract-Service)

### Generating Repository:
>It can be generating class repository.

```
    $ php artisan make:repository UserRepository
```

* Supported:
    * [Abstract Repository](https://github.com/Mombuyish/Laravel-Oh-Generators/wiki/Abstract-Repository)

### Generating Transformer:
> It can be generating class transformer.

```
    $ php artisan make:transformer UserTransformer
```

* Supported:
    * Helpers
    * TransformContract

### Generating Formatter
> It can be generating class formatter.

```
    $ php artisan make:formatter UserFormatter
```

* Supported: 
    * Statusable
    * Helpers
    * FormatContract


### Generating Presenter
> It can be generating class presenter.

```
    $ php artisan make:presenter UserPresenter
```

If you need more examples and documentation, see [documentation](https://github.com/Mombuyish/Laravel-Oh-Generators/wiki).