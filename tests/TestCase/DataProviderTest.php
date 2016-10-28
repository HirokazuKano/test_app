<?php
/**
 * Created by PhpStorm.
 * User: Hirokazu
 * Date: 2016/10/11
 * Time: 9:51
 */


use PHPUnit\Framework\TestCase;

class DataProviderTest extends PHPUnit_Framework_TestCase
{
    public function provider()
    {
        return [['provider1'], ['provider2']];
    }

    public function testProducerFirst()
    {
        $this->assertTrue(true);
        return 'first';
    }

    public function testProducerSecond()
    {
        $this->assertTrue(true);
        return 'second';
    }

    /**
     * @depends testProducerFirst
     * @depends testProducerSecond
     * @dataProvider provider
     */
    public function testConsumer()
    {
        var_dump(func_get_args());
        $this->assertEquals(
            ['provider2', 'first', 'second'],
            func_get_args()
        );
    }


    /**
     * @dataProvider additionProvider
     */
    public function testAdd($a, $b, $expected)
    {
//        var_dump(func_get_args());
        $this->assertEquals($expected, $a + $b);
    }

    public function additionProvider()
    {
        return [
            'adding zeros'  => [0, 0, 0],
            'zero plus one' => [0, 1, 1],
            'one plus zero' => [1, 0, 1],
            'one plus one'  => [1, 1, 2]
        ];
    }

}