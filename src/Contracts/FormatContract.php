<?php

namespace Yish\Generators\Contracts;

use Illuminate\Http\Request;

interface FormatContract
{
    public function format(Request $request, $items);
}