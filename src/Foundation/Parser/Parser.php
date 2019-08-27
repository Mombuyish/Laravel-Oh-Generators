<?php

namespace Yish\Generators\Foundation\Parser;

abstract class Parser
{
    public function parse(array $items)
    {
        $result = [];
        if (! empty($items) && is_array($items)) {
            $result = array_combine($this->keys(), $items);
        }

        return $result;
    }

    abstract public function keys();
}