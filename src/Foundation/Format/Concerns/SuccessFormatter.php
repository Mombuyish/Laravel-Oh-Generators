<?php

namespace Yish\Generators\Foundation\Format\Concerns;


use Illuminate\Http\Request;

trait SuccessFormatter
{
    public function success(Request $request, array $items, $status = 200, $message = '')
    {
        $this->result = [
            'link' => $request->fullUrl(),
            'method' => $request->getMethod(),

            'code' => $status,
            'message' => $message ?: $this->getErrorMessage(),

            'items' => $items
        ];

        return $this;
    }
}