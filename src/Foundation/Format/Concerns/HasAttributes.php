<?php

namespace Yish\Generators\Foundation\Format\Concerns;


trait HasAttributes
{
    /**
     * @var string
     * Call on method.
     */
    protected $attribute = 'success';

    public function setAttribute($attribute)
    {
        $this->attribute = $attribute;

        return $this;
    }

    public function getAttribute()
    {
        return $this->attribute;
    }
}