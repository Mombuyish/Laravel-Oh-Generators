<?php

namespace Yish\Generators\Foundation\Format\Concerns;

use Illuminate\Http\Request;

trait FailFormatter
{
    public function setFailed(Request $request, $items, $status = 200, $message = '')
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