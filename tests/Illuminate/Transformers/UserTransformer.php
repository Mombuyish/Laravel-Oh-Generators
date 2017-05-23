<?php

namespace Yish\Generators\Tests\Illuminate\Transformers;


use Yish\Generators\Foundation\Transform\TransformContract;

class UserTransformer implements TransformContract
{
    public function transform($attributes)
    {
        return [
          'name' => $attributes['name'],
        ];
    }
}