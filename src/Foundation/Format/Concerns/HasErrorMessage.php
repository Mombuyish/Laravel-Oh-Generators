<?php

namespace Yish\Generators\Foundation\Format\Concerns;


trait HasErrorMessage
{
    protected $defaultErrorMessage = 'Oops, something have wrong.';

    public function getErrorMessage()
    {
        return $this->defaultErrorMessage;
    }

    public function setErrorMessage($message)
    {
        $this->defaultErrorMessage = $message;
    }
}