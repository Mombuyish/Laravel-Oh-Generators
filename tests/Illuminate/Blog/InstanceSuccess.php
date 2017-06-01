<?php

namespace Yish\Generators\Tests\Illuminate\Blog;

use Illuminate\Http\Request;
use Yish\Generators\Foundation\Format\FormatContract;

class InstanceSuccess implements FormatContract
{
    public function format(Request $request, $items = [], $message = '', $status = 200)
    {
        return [
            'link' => url('/'),
            'method' => 'GET',
            'code' => $status,
            'message' => 'Hello boys.',
            'items' => $items
        ];
    }
}