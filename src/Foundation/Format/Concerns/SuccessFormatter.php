<?php

namespace Yish\Generators\Foundation\Format\Concerns;


use Illuminate\Http\Request;

trait SuccessFormatter
{
    public function setSuccess(Request $request, $items, $status = 200, $message = '')
    {
        $this->result = [
            'link' => $request->fullUrl(),
            'method' => $request->getMethod(),

            'code' => $status,
            'message' => $message ?: $this->getSuccessMessage(),

            'items' => $items
        ];

        return $this;
    }
}