<?php

namespace Yish\Generators\Tests\Illuminate\Blog\Custom;

use Yish\Generators\Foundation\Format\FormatContract;
use Yish\Generators\Foundation\Format\Statusable;

class FailedMessage implements FormatContract
{
    use Statusable;

    protected $status = false;

    public function message()
    {
        return 'Failed boys.';
    }
}