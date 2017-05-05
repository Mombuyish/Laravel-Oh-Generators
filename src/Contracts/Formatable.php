<?php

namespace Yish\Generators\Contracts;

use Illuminate\Http\Request;

interface Formatable
{
    public function format(Request $request, $items);
}