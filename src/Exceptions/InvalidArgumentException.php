<?php

namespace Yish\Generators\Exceptions;

use Exception;

class InvalidArgumentException extends Exception
{
    public function __construct($property)
    {
        parent::__construct("{$property} does not exist.");
    }
}