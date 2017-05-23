<?php

namespace Yish\Generators\Tests;

use Yish\Generators\Tests\Illuminate\Presenters\UserPresenter;

class PresenterTest extends TestCase
{
    /**
     * @test
     * @group package-presenter
     */
    public function it_should_return_specific_data()
    {
        $expected = 'male';

        $presenter = app(UserPresenter::class);

        $result = $presenter->gender(0);

        $this->assertEquals($expected, $result);
    }
}