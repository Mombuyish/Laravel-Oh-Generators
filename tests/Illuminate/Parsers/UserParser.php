<?php

namespace Yish\Generators\Tests\Illuminate\Parsers;

use Yish\Generators\Foundation\Parser\Parser;

class UserParser extends Parser
{
    public function parse(array $items)
    {
        return parent::parse($items);
    }

    public function keys()
    {
        return [
            'name',
            'ages',
            'location'
        ];
    }
}