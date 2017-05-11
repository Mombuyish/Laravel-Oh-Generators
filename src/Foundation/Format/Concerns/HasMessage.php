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

    public function replaceMessage()
    {
        //call in message method.
        $static = call_user_func(function () {
            return (new static)->message();
        });

        // if you have give a string in message method, it will replace default message.
        if (! empty($static)) {
            $this->setMessage($static);
        }

        //if not, set default message.
        if ($this->isSuccess()) {
            $this->setMessage($this->message);
        } else {
            $this->setMessage($this->errorMessage);
        }
    }
}