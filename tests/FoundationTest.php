<?php

namespace Yish\Generators\Tests;

use Yish\Generators\Tests\Illuminate\Foundations\ThridPartyFoundation;

class FoundationTest extends TestCase
{
    /**
     * @test
     * @group package-foundation
     */
    public function it_should_return_specific_data()
    {

        $testee = app(ThridPartyFoundation::class);

        $expected = 'Action 0';
        $actual = $testee->doPluginAction(0);
        $this->assertEquals($expected, $actual);

        $expected = 'Action 1';
        $actual = $testee->doPluginAction(1);
        $this->assertEquals($expected, $actual);

        $expected = 'No Effect';
        $actual = $testee->doPluginAction(2);
        $this->assertEquals($expected, $actual);
    }
}
