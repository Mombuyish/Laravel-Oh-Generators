<?php

namespace Yish\Generators\Foundation\Format;

use Illuminate\Http\Request;

interface FormatContract
{
    public function format(Request $request, $items = []);
}