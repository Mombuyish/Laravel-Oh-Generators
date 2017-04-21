<?php

namespace Yish\Generators\Contracts;


interface Validatable
{
    public function validate($attribute, $value, $parameters, $validator);
}