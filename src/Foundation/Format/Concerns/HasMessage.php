<?php

namespace Yish\Generators\Foundation\Format\Concerns;

trait HasMessage
{
    /**
     * Get message.
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set message.
     *
     * @param $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * Replace message code if instance code method from static.
     *
     * @return $this
     */
    public function replaceMessage()
    {
        if (method_exists(new static, 'message')) {
            $message = call_user_func(function () {
                return (new static)->message();
            });

            $this->setMessage($message);

            return $this;
        }

        //if not, set default message.
        if ($this->decideStatus()) {
            $this->setMessage($this->message);

            return $this;
        }

        $this->setMessage($this->errorMessage);

        return $this;
    }
}