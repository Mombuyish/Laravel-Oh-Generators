<?php

namespace Yish\Generators\Foundation\Transform;


abstract class Transformer
{
    /**
     * Determine if the items is empty or not.
     *
     * @param $items
     * @return bool
     */
    public function isEmpty($items)
    {
        return empty($items);
    }

    /**
     * Determine if the items is not empty.
     *
     * @param $items
     * @return bool
     */
    public function isNotEmpty($items)
    {
        return ! $this->isEmpty($items);
    }
}
