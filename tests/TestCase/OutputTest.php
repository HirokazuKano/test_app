<?php
/**
 * Created by PhpStorm.
 * User: Hirokazu
 * Date: 2016/10/11
 * Time: 9:51
 */


use PHPUnit\Framework\TestCase;

class OutputTest extends PHPUnit_Framework_TestCase
{
    public function testExpectFooActualFoo()
    {
        $this->expectOutputString('foo');
        print 'foo';
    }

    public function testExpectBarActualBaz()
    {
        $this->expectOutputString('bar');
        print 'bar';
    }
}