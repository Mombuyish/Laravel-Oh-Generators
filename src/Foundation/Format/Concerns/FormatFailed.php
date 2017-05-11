<?php

namespace Yish\Generators\Foundation\Format\Concerns;


trait FormatFailed
{
    /**
     * @param array $errors
     * @return array Merge failed required format to base format.
     *
     * Merge failed required format to base format.
     */
    private function setFailedFormat($errors = [])
    {
        return [
            'errors' => $errors,
        ];
    }
}