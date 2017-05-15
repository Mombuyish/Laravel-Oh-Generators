<?php

namespace Yish\Generators\Foundation\Format\Concerns;


use Illuminate\Http\Response;

trait HasCode
{
    protected $code;

    public function setCode($code)
    {
        $this->code = $code;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function replaceCode()
    {
        //call in message method.
        $static = call_user_func(function () {
            return (new static)->code();
        });

        if (! empty($static)) {
            $this->setCode($static);

            return $this->getCode();
        }

        if ($this->isSuccess()) {
            $this->setCode(Response::HTTP_OK);

            return $this->getCode();
        }

        $this->setCode(Response::HTTP_UNPROCESSABLE_ENTITY);

        return $this->getCode();
    }
}