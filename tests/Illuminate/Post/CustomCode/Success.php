<?php

namespace Yish\Generators\Tests\Illuminate\Post\CustomCode;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yish\Generators\Foundation\Format\FormatContract;
use Yish\Generators\Foundation\Format\Statusable;
use Yish\Generators\Foundation\Format\Formatter;

class Success extends Formatter implements FormatContract
{
   use Statusable;

    public function code()
    {
        return Response::HTTP_ACCEPTED;
   }
}