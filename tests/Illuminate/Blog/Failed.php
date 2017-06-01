<?php

namespace Yish\Generators\Tests\Illuminate\Blog;

use Yish\Generators\Foundation\Format\FormatContract;
use Yish\Generators\Foundation\Format\Statusable;

class Failed implements FormatContract
{
    protected $status = false;

    use Statusable;
}