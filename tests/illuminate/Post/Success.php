<?php

namespace Yish\Generators\Tests\Illuminate\Post;

use Illuminate\Http\Request;
use Yish\Generators\Foundation\Format\FormatContract;
use Yish\Generators\Foundation\Format\SuccessAndFailed;
use Yish\Generators\Foundation\Format\Formatter;

class Success extends Formatter implements FormatContract
{
    public function format(Request $request, $items, $message = '', $status = 200)
    {
        return [
            'link' => url('/test/package'),
            'method' => 'GET',
            'code' => $status,
            'message' => $message,
            'items' => $items
        ];
    }
}