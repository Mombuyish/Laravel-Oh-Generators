<?php

namespace Yish\Generators\Foundation\Format\Concerns;

trait FormatSuccess
{
    /**
     * @param $items
     * @return array Merge success required format to base format.
     *
     * Merge success required format to base format.
     */
    protected function setSuccessFormat($items)
    {
        return [
            'items' => $items,
        ];
    }
}