<?php

namespace Yish\Generators\Foundation\Format;

use Illuminate\Http\Request;
use Yish\Generators\Exceptions\MethodNotFoundException;
use Yish\Generators\Foundation\Format\Concerns\FailFormatter;
use Yish\Generators\Foundation\Format\Concerns\HasFailedMessage;
use Yish\Generators\Foundation\Format\Concerns\HasSuccessMessage;
use Yish\Generators\Foundation\Format\Concerns\SuccessFormatter;

trait Formatable
{
    use FailFormatter,
        HasFailedMessage,
        SuccessFormatter,
        HasSuccessMessage;

    /**
     * @var static
     * Return property.
     */
    protected $result;

    public function format(Request $request, $items)
    {
        $status = $this->getStatus();

        return static::$status($request, $items)->getResult();
    }

    public function getStatus()
    {
        if (! method_exists(static::class, 'success')) {
            throw new MethodNotFoundException('success');
        }

        return (bool) static::success() ? 'setSuccess' : 'setFailed';
    }

    public function getResult()
    {
        return $this->result;
    }
}