<?php

namespace Yish\Generators\Foundation\Format;

abstract class Formatter
{
    /**
     * @var bool
     * If you use FormatSuccessAndFailed, you can determine format success or failed.
     */
    protected $status = true;

    /**
     * @return string
     * If you use FormatSuccessAndFailed, you can customize format message.
     */
    public function message()
    {
        return '';
    }
}