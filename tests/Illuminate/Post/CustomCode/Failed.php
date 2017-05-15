<?php

namespace Yish\Generators\Tests\Illuminate\Post\CustomCode;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yish\Generators\Foundation\Format\FormatContract;
use Yish\Generators\Foundation\Format\SuccessAndFailed;
use Yish\Generators\Foundation\Format\Formatter;

class Failed extends Formatter implements FormatContract
{
    use SuccessAndFailed;

    protected $status = false;

    public function code()
    {
        return Response::HTTP_INTERNAL_SERVER_ERROR;
    }
}