<?php

use Yish\Generators\Exceptions\ClassNotFoundException;
use Yish\Generators\Exceptions\MethodNotFoundException;
use Illuminate\Http\Request;

if (! function_exists('transform')) {
    function transform($instance, $attributes)
    {
        if (! class_exists($instance)) {
            throw new ClassNotFoundException($instance);
        }

        return app($instance)->transform($attributes);
    }
}

if (! function_exists('format')) {
    function format(Request $request, $instance, $items)
    {
        if (! class_exists($instance)) {
            throw new ClassNotFoundException($instance);
        }

        return app($instance)->format($request, $items);
    }
}