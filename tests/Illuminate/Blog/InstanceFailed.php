<?php

namespace Yish\Generators\Tests\Illuminate\Blog;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yish\Generators\Foundation\Format\FormatContract;

class InstanceFailed implements FormatContract
{
    public function format(Request $request, $items = [], $message = '', $status = 200)
    {
        return [
            'link' => url('/'),
            'method' => 'GET',
            'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
            'message' => 'Failed.',
            'errors' => $items
        ];
    }
}