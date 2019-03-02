<?php

use Yish\Generators\Exceptions\ClassNotFoundException;
use Illuminate\Http\Request;

if (! function_exists('transformer')) {
    function transformer($instance, $attributes)
    {
        if (! class_exists($instance)) {
            throw new ClassNotFoundException($instance);
        }

        return app($instance)->transform($attributes);
    }
}

if (! function_exists('formatter')) {
    function formatter(Request $request, $instance, $items)
    {
        if (! class_exists($instance)) {
            throw new ClassNotFoundException($instance);
        }

        return app($instance)->format($request, $items);
    }
}