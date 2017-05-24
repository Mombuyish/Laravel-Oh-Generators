<?php

namespace Yish\Generators\Tests\Illuminate\Article;

use Illuminate\Http\Request;
use Yish\Generators\Foundation\Format\FormatContract;
use Yish\Generators\Foundation\Format\Statusable;
use Yish\Generators\Foundation\Format\Formatter;

class Success extends Formatter implements FormatContract
{
    use Statusable;
    //
}