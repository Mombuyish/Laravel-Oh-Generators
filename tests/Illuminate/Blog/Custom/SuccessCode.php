<?php

namespace Yish\Generators\Tests\Illuminate\Blog\Custom;

use Illuminate\Http\Response;
use Yish\Generators\Foundation\Format\FormatContract;
use Yish\Generators\Foundation\Format\Statusable;

class SuccessCode implements FormatContract
{
    use Statusable;

    protected $status = true;

    public function code()
    {
        return Response::HTTP_ACCEPTED;
    }
}