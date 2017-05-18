<?php

namespace Yish\Generators\Foundation\Format\Concerns;


use Illuminate\Http\Response;

/**
 * Trait HasCode
 * @package Yish\Generators\Foundation\Format\Concerns
 */
trait HasCode
{
    protected $code;

    /**
     * set status code.
     *
     * @param $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * Get status code.
     *
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Replace status code if instance code method from static.
     *
     * @param $code
     * @return $this
     */
    public function replaceCode($code)
    {
        if (method_exists(new static, 'code')) {
            $code = call_user_func(function () {
                return (new static)->code();
            });

            $this->setCode($code);

            return $this;
        }

        if (! empty($code)) {
            $this->setCode($code);

            return $this;
        }

        if ($this->isSuccess()) {
            $this->setCode(Response::HTTP_OK);

            return $this;
        }

        $this->setCode(Response::HTTP_UNPROCESSABLE_ENTITY);

        return $this;
    }
}