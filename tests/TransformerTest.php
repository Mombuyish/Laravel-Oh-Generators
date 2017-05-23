<?php

namespace Yish\Generators\Tests;

use Yish\Generators\Tests\Illuminate\Transformers\UserTransformer;

class TransformerTest extends TestCase
{
    /**
     * @test
     * @group package-transformer
     */
    public function it_should_return_specific_data()
    {
        $expected = ['name' => 'yish'];

        $transformer = app(UserTransformer::class);

        $this->assertEquals($expected, $transformer->transform([
            'name' => 'yish',
            'age' => 28
        ]));
    }

    /**
     * @test
     * @group package-transformer
     */
    public function it_should_transform_by_helper()
    {
        $expected = ['name' => 'yish'];

        $result = transform(UserTransformer::class, [
            'name' => 'yish',
            'age' => 28
        ]);

        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     * @group package-transformer
     */
    public function it_should_not_found_class_by_helper()
    {
        $this->expectException(\Yish\Generators\Exceptions\ClassNotFoundException::class);

        transform(ABCD::class, []);
    }

    /**
     * @test
     * @group package-transformer
     */
    public function it_should_not_found_method_by_helper()
    {
        $this->expectException(\Yish\Generators\Exceptions\MethodNotFoundException::class);

        transform(UserTransformer::class, [], 'abcd');
    }
}