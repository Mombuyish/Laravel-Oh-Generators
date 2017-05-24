<?php

namespace Yish\Generators\Tests\Illuminate\Post\CustomMessage;

use Illuminate\Http\Request;
use Yish\Generators\Foundation\Format\FormatContract;
use Yish\Generators\Foundation\Format\Statusable;
use Yish\Generators\Foundation\Format\Formatter;

class Success extends Formatter implements FormatContract
{
    use Statusable;

    public function message()
    {
        return 'Hello boys.';
    }
}