<?php

namespace Yish\Generators\Tests\Illuminate\Blog\Custom;

use Yish\Generators\Foundation\Format\FormatContract;
use Yish\Generators\Foundation\Format\Statusable;

class SuccessMessage implements FormatContract
{
    use Statusable;

    protected $status = true;

    public function message()
    {
        return 'Hello boys.';
    }
}