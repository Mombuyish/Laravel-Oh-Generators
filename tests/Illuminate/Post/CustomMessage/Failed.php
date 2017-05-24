<?php

namespace Yish\Generators\Tests\Illuminate\Post\CustomMessage;

use Illuminate\Http\Request;
use Yish\Generators\Foundation\Format\FormatContract;
use Yish\Generators\Foundation\Format\Statusable;
use Yish\Generators\Foundation\Format\Formatter;

class Failed extends Formatter implements FormatContract
{
    use Statusable;

    protected $status = false;

    public function message()
    {
        return "OOOOOOOops";
    }
}