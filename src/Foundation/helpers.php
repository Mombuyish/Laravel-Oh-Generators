<?php

use Yish\Generators\Exceptions\ClassNotFoundException;
use Yish\Generators\Exceptions\MethodNotFoundException;
use Illuminate\Http\Request;

if (! function_exists('transform')) {
    function transform($instance, $attributes, $method = 'transform')
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
    function format(Request $request, $instance, $items, $message = '', $status = 200, $method = 'format')
    {
        if (! class_exists($instance)) {
            throw new ClassNotFoundException($instance);
        }

        if (! method_exists($instance, $method)) {
            throw new MethodNotFoundException($method);
        }

        return app($instance)->$method($request, $items, $message, $status);
    }
}