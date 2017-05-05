<?php

use Yish\Generators\Contracts\Formatable;
use Yish\Generators\Contracts\Transformable;
use Yish\Generators\Exceptions\ClassNotFoundException;
use Yish\Generators\Exceptions\MethodNotFoundException;

if (! function_exists('transform')) {
    function transform(Transformable $instance, $attributes, $method = 'transform')
    {
        if (! class_exists($instance)) {
            throw new ClassNotFoundException($instance);
        }

        if (! method_exists($instance, $method)) {
            throw new MethodNotFoundException($method);
        }

        return app($instance)->$method($attributes);
    }
}

if (! function_exists('format')) {
    function format(Formatable $instance, $items, $method = 'format')
    {
        if (! class_exists($instance)) {
            throw new ClassNotFoundException($instance);
        }

        if (! method_exists($instance, $method)) {
            throw new MethodNotFoundException($method);
        }

        return app($instance)->$method($items);
    }
}