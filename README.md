<p align="center"><svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path fill="#f4645f" d="M20 21c-1.39 0-2.78-.47-4-1.32-2.44 1.71-5.56 1.71-8 0C6.78 20.53 5.39 21 4 21H2v2h2c1.38 0 2.74-.35 4-.99 2.52 1.29 5.48 1.29 8 0 1.26.65 2.62.99 4 .99h2v-2h-2zM3.95 19H4c1.6 0 3.02-.88 4-2 .98 1.12 2.4 2 4 2s3.02-.88 4-2c.98 1.12 2.4 2 4 2h.05l1.89-6.68c.08-.26.06-.54-.06-.78s-.34-.42-.6-.5L20 10.62V6c0-1.1-.9-2-2-2h-3V1H9v3H6c-1.1 0-2 .9-2 2v4.62l-1.29.42c-.26.08-.48.26-.6.5s-.15.52-.06.78L3.95 19zM6 6h12v3.97L12 8 6 9.97V6z"/></svg></p>

<p align="center">
<a href="https://travis-ci.org/Mombuyish/Laravel-Oh-Generators"><img src="https://travis-ci.org/Mombuyish/Laravel-Oh-Generators.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/yish/generators"><img src="https://poser.pugx.org/yish/generators/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/yish/generators"><img src="https://poser.pugx.org/yish/generators/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/yish/generators"><img src="https://poser.pugx.org/yish/generators/license.svg" alt="License"></a>
<a href="https://packagist.org/packages/yish/generators"><img src="https://poser.pugx.org/yish/generators/v/unstable.svg" alt="License"></a>
</p>

# Laravel Oh Generators

> This package extends the core file generators that are included with Laravel 5 / 6

[Docs site](https://packages.yish.dev/packages/laravel-oh-generator.html)

# Installation

Install by composer
```
    $ composer require yish/generators
```

* 5.4 before using branch `1.1.x`
* 5.5 ~ 5.7 using branch `2.0.x`
* 5.8 or later using branch `2.1.x`

Registing Service Provider

If you are using laravel 5.5, you can use auto discover also, you don't need put in service provider to `app.php`.

``` php
<?php

//app.php

'providers' => [
        \Yish\Generators\GeneratorsServiceProvider::class,
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

### Generating Foundation
> It can be generating class foundation.

```
    $ php artisan make:foundation Taggable
```


If you need more examples and documentation, see [documentation](https://github.com/Mombuyish/Laravel-Oh-Generators/wiki).
