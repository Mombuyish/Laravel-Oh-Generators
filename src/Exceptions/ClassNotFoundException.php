<?php

namespace Yish\Generators\Exceptions;

use Exception;

class ClassNotFoundException extends Exception
{
    public function __construct($class)
    {
        parent::__construct("{$class} does not exist.");
    }
}