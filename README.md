# Laravel Oh Generators

<p>
<a href="https://travis-ci.org/Mombuyish/Laravel-Oh-Generators"><img src="https://travis-ci.org/Mombuyish/Laravel-Oh-Generators.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/yish/generators"><img src="https://poser.pugx.org/yish/generators/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/yish/generators"><img src="https://poser.pugx.org/yish/generators/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/yish/generators"><img src="https://poser.pugx.org/yish/generators/license.svg" alt="License"></a>
<a href="https://packagist.org/packages/yish/generators"><img src="https://poser.pugx.org/yish/generators/v/unstable.svg" alt="License"></a>
</p>

This package extends the core file generators that are included with Laravel 5 / 6

## Requirement
#### PHP >= 7
#### Laravel >= 5
- 5.4 before using branch `1.1.x`
- 5.5 ~ 5.7 using branch `2.0.x`
- 5.8 - 6.x using branch `3.x.x`

## Installation

Install via composer
``` bash
$ composer require yish/generators
```

#### Registing Service Provider

If you are using laravel 5.5 or later, you can use auto discover, you don't need put in service provider to `app.php`.

``` php
<?php
//app.php
'providers' => [
    \Yish\Generators\GeneratorsServiceProvider::class,
],
```

## Generating Service
It can be generating class service.
``` bash
$ php artisan make:service UserService
```
``` php
<?php
namespace App\Services;

use Yish\Generators\Foundation\Service\Service;

class UserService
{
    protected $repository;

    //
}
```
Also, it supports abstract service.
You should inject your repository or model and then use it.
``` php
all()
create($attributes)
first()
firstBy($column, $value)
find($id)
findBy($column, $value)
get()
getBy($column, $value)
update($id, $attributes)
updateBy($column, $value, $attributes)
destroy($id)
destroyBy($column, $value)
paginate($page = 12)
paginateBy($column, $value, $page = 12)
```

## Generating Repository
It can be generating class repository.
``` bash
$ php artisan make:repository UserRepository
```
``` php
<?php
namespace App\Repositories;

use Yish\Generators\Foundation\Repository\Repository;

class UserRepository
{
    protected $model;

    //
}
```
Also, it supports abstract repository.
You should inject your model and then use it.
``` php
all($columns = ['*'])
create($attributes)
update($id, array $attributes, array $options = [])
updateBy($column, $value, array $attributes = [], array $options = [])
first($columns = ['*'])
firstBy($column, $value, $columns = ['*'])
find($id, $columns = ['*'])
findBy($column, $value, $columns = ['*'])
get($columns = ['*'])
getBy($column, $value, $columns = ['*'])
destroy($ids)
destroyBy($column, $value)
paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null)
paginateBy($column, $value, $perPage = null, $columns = ['*'], $pageName = 'page', $page = null)
```

## Generating Transformer
It can be generating class transformer.
``` bash
$ php artisan make:transformer UserTransformer
```
### Support
#### TransformContract
``` php
<?php
namespace Yish\Generators\Foundation\Transform;
interface TransformContract
{
    public function transform($attributes);
}
```
#### Helper / transformer()
``` php
// $instance => Transformer class.
// $attributes => Need transform data, maybe array or collection etc.
transformer(UserTransformer::class, $data);
```

## Generating Formatter
It can be generating class formatter.
``` bash
$ php artisan make:formatter UserFormatter
```
``` php
<?php

namespace App\Formatters;

use Illuminate\Http\Request;
use Yish\Generators\Foundation\Format\FormatContract;
use Yish\Generators\Foundation\Format\Statusable;

class PostFormatter implements FormatContract
{
    public function format(Request $request, $items = [], $message = '', $status = 200)
    {
        //
    }
}
```
### Support
#### FormatContract
``` php
<?php
namespace Yish\Generators\Foundation\Format;
use Illuminate\Http\Request;
interface FormatContract
{
    public function format(Request $request, $items = []);
}
```
#### Statusable
You can use `Statusable` trait to help you faster building formalize format.
Set property `$status = true`, you can get success format. `$status` must be boolean, if not you will get exception.
``` php
<?php

namespace App\Formatters;

use Illuminate\Http\Request;
use Yish\Generators\Foundation\Format\FormatContract;
use Yish\Generators\Foundation\Format\Statusable;

class PostFormatter implements FormatContract
{
    use Statusable;

    protected $status = true;
}
```
If not, you can set `false` to get failed format.
``` php
<?php

namespace App\Formatters;

use Illuminate\Http\Request;
use Yish\Generators\Foundation\Format\FormatContract;
use Yish\Generators\Foundation\Format\Statusable;

class PostFormatter implements FormatContract
{
    use Statusable;
    
    protected $status = false;
}
```
If you need customize message, you can do:
``` php
<?php

namespace App\Formatters;

use Illuminate\Http\Request;
use Yish\Generators\Foundation\Format\FormatContract;
use Yish\Generators\Foundation\Format\Statusable;

class PostFormatter implements FormatContract
{
    use Statusable;
    
    protected $status = false;
    
    public function message()
    {
        return 'hello world'.
    }
}
```
Or you can customize status code, you can do:
``` php
<?php

namespace App\Formatters;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yish\Generators\Foundation\Format\FormatContract;
use Yish\Generators\Foundation\Format\Statusable;
use Yish\Generators\Foundation\Format\Formatter;

class Success extends Formatter implements FormatContract
{
   use Statusable;

    protected $status = false;

    public function code()
    {
        return Response::HTTP_ACCEPTED;
    }
}
```
If you need to customize what you need, check out `Yish\Generators\Foundation\Format\Statusable` get more detail.

#### Helper / formatter()
``` php
// $request => Must instance of `Illuminate\Http\Request`.
// $instance => Formatter class.
// $items => data.
formatter(request(), UserFormatter::class, $data);
```

## Generating Presenter
It can be generating class presenter.
``` bash
$ php artisan make:presenter UserPresenter
```
``` php
<?php

namespace App\Presenters;

class UserPresenter
{
    //
}
```

## Generating Foundation
It can be generating class foundation.
``` bash
$ php artisan make:foundation Taggable
```
``` php
<?php

namespace App\Foundation;

class Taggable
{
  //
}
```

## Generating Transport
It can be generating class transport.
``` bash
$ php artisan make:transport UserTransport
```
``` php
<?php

namespace App\Transports;

class UserTransport
{
  //
}
```

## Generating Parser
It can be generating class parser.
``` bash
$ php artisan make:parser UserParser
```
``` php
<?php

namespace App\Parsers;

use Yish\Generators\Foundation\Parser\Parser;

class UserParser extends Parser
{
    public function parse(array $items)
    {
        return parent::parse($items);
    }

    public function keys()
    {
        return [
            'name',
            'ages',
            'location'
        ];
    }
}
```
``` php
$parser = app(UserParser::class)->parse(['Yish', 30, 'Taipei']);
// ['name' => 'Yish', 'ages' => 30, 'location' => 'Taipei'];
```