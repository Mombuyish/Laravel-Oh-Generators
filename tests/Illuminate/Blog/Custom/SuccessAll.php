<?php

namespace Yish\Generators\Tests\Illuminate\Blog\Custom;

use Illuminate\Http\Response;
use Yish\Generators\Foundation\Format\FormatContract;
use Yish\Generators\Foundation\Format\Statusable;

class SuccessAll implements FormatContract
{
    use Statusable;

    protected $status = true;

    public function code()
    {
        return Response::HTTP_ACCEPTED;
    }

    public function message()
    {
        return 'Hello boys.';
    }
}