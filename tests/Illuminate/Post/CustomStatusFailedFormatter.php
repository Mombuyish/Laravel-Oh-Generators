<?php

namespace Yish\Generators\Tests\Illuminate\Post;


use Yish\Generators\Foundation\Format\FormatContract;
use Yish\Generators\Foundation\Format\Formatter;
use Yish\Generators\Foundation\Format\Statusable;

class CustomStatusFailedFormatter extends Formatter implements FormatContract
{
    use Statusable;

    protected $status = false;
}