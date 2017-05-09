<?php

use Yish\Generators\Exceptions\ClassNotFoundException;
use Yish\Generators\Exceptions\MethodNotFoundException;
use Illuminate\Http\Request;

if (! function_exists('transform')) {
    function transform(Request $request, $instance, $attributes, $method = 'transform')
    {
        if (! class_exists($instance)) {
            throw new ClassNotFoundException($instance);
        }

        if (! method_exists($instance, $method)) {
            throw new MethodNotFoundException($method);
        }

        return app($instance)->$method($request, $attributes);
    }
}

if (! function_exists('format')) {
    function format(Request $request, $instance, $items, $method = 'format')
    {
        if (! class_exists($instance)) {
            throw new ClassNotFoundException($instance);
        }

        if (! method_exists($instance, $method)) {
            throw new MethodNotFoundException($method);
        }

        return app($instance)->$method($request, $items);
    }
}