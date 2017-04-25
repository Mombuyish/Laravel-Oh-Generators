<?php

use Yish\Generators\Exceptions\ClassNotFoundException;
use Yish\Generators\Exceptions\MethodNotFoundException;

if (! function_exists('transform')) {
    function transform($class, $attributes)
    {
        if (! class_exists($class)) {
            throw new ClassNotFoundException($class);
        }

        if (! method_exists($class, $method = 'transform')) {
            throw new MethodNotFoundException($method);
        }

        return app($class)->$method($attributes);
    }
}