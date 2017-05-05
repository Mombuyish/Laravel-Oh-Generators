<?php

namespace Yish\Generators\Foundation\Format;

use Illuminate\Http\Request;
use Yish\Generators\Foundation\Format\Concerns\FailFormatter;
use Yish\Generators\Foundation\Format\Concerns\HasAttributes;
use Yish\Generators\Foundation\Format\Concerns\HasErrorMessage;
use Yish\Generators\Foundation\Format\Concerns\SuccessFormatter;

trait Formatable
{
    use SuccessFormatter,
        FailFormatter,
        HasAttributes,
        HasErrorMessage;

    /**
     * @var
     * Return property.
     */
    protected $result;

    public function format(Request $request, $items)
    {
        $status = $this->getAttribute();

        return static::$status($request, $items)->getResult();
    }

    public function getResult()
    {
        return $this->result;
    }
}