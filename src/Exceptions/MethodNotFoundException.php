<?php

namespace Yish\Generators\Exceptions;

use Exception;

class MethodNotFoundException extends Exception
{
    public function __construct($method)
    {
        parent::__construct("{$method} does not exist. Implement it please.");
    }
}