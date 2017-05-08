<?php

namespace Yish\Generators\Foundation\Format\Concerns;


trait HasSuccessMessage
{
    protected $defaultSuccessMessage = 'Get something successful.';

    public function getSuccessMessage()
    {
        return $this->defaultSuccessMessage;
    }

    public function setSuccessMessage($message)
    {
        $this->defaultSuccessMessage = $message;
    }
}