<?php

namespace Yish\Generators\Tests;

use Yish\Generators\Tests\Illuminate\Parsers\UserParser;

class ParserTest extends TestCase
{

    /**
     * @test
     * @group package-parser
     */
    public function it_should_return_specific_data()
    {
        $expected = [
            'name' => 'yish',
            'ages' => 30,
            'location' => 'Taipei'
        ];

        $parser = app(UserParser::class);

        $result = $parser->parse(['yish', 30, 'Taipei']);

        $this->assertEquals($expected, $result);
    }
}