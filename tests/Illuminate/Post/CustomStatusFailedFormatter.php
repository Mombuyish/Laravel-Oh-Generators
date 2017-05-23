<?php

namespace Yish\Generators\Tests\Illuminate\Post;


use Yish\Generators\Foundation\Format\FormatContract;
use Yish\Generators\Foundation\Format\Formatter;
use Yish\Generators\Foundation\Format\SuccessAndFailed;

class CustomStatusFailedFormatter extends Formatter implements FormatContract
{
    use SuccessAndFailed;

    protected $status = false;
}