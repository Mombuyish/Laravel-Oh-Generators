<?php

namespace Yish\Generators\Foundation\Format\Concerns;


trait HasMessage
{
    protected $message = 'Get something successful.';

    protected $errorMessage = 'Oops, something have wrong.';

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function setErrorMessage()
    {
        $this->message =  $this->errorMessage;
    }
}