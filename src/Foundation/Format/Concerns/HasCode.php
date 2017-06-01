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
     * @return $this
     */
    public function replaceCode()
    {
        if (method_exists($this, 'code')) {
            $code = call_user_func(function () {
                return $this->code();
            });

            $this->setCode($code);

            return $this;
        }

        if ($this->decideStatus()) {
            $this->setCode(Response::HTTP_OK);

            return $this;
        }

        $this->setCode(Response::HTTP_UNPROCESSABLE_ENTITY);

        return $this;
    }
}