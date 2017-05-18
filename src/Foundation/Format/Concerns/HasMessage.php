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
     * @param $message
     * @return $this
     */
    public function replaceMessage($message)
    {
        if (method_exists(new static, 'message')) {
            $message = call_user_func(function () {
                return (new static)->message();
            });

            $this->setMessage($message);

            return $this;
        }

        if (! empty($message)) {
            $this->setMessage($message);

            return $this;
        }

        //if not, set default message.
        if ($this->isSuccess()) {
            $this->setMessage($this->message);

            return $this;
        }

        $this->setMessage($this->errorMessage);

        return $this;
    }
}