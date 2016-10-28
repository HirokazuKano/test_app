<?php
/**
 * ダミーオブジェクトを使ったテストサンプル
 * Created by PhpStorm.
 * User: Hirokazu
 * Date: 2016/10/11
 * Time: 9:51
 */

use UnitTest\App\Baz;
use UnitTest\App\Foo;

class DummyObjectTest extends \PHPUnit_Framework_TestCase
{
    /**
     * getMockBuilderで仮のクラスを作る
     */
    public function testExpectFooActualFoo()
    {
        $foo = $this->getMockBuilder('Foo')->getMock();
        //var_dump($foo);
        $bar = $this->getMockBuilder('Bar')
            ->setMethods(array('getStatus', 'merge'))
            ->getMock();
        $bar->expects($this->once())
            ->method('getStatus')
            ->will($this->returnValue('merge-ready'));
        //var_dump($bar);

        $baz = new Baz($foo, $bar);
        $expectedResult = true;
        $testResult = $baz->mergeBar();

        $this->assertEquals(
            $expectedResult,
            $testResult,
            'Baz::mergeBar は、Bar オブジェクトを正しく統合しなかった'
        );
    }

    /**
     * $this->at() メソッドが実行された回数に基づいて、期待される戻り値を設定したい場合に使用
     * $this->any() には実行の回数は関係ない
     * $this->never() は、メソッドが実行されないことを期待する
     * $this->once() は、メソッドがテスト中に 1 回だけ呼び出されることを期待する。
     */
    public function testShowingUsingAt()
    {
        $foo = $this->getMockBuilder('Foo')
            ->setMethods(array('bar'))
            ->getMock();

        $foo->expects($this->at(0))
            ->method('bar')
            ->will($this->returnValue(0));

        $foo->expects($this->at(1))
            ->method('bar')
            ->will($this->returnValue(1));

        $foo->expects($this->at(2))
            ->method('bar')
            ->will($this->returnValue(2));

        $this->assertEquals(0, $foo->bar());
        $this->assertEquals(1, $foo->bar());
        $this->assertEquals(2, $foo->bar());
    }

    /**
     * returnValueMap()でメソッドbarに引数と返り値を決めて渡す
     */
    public function testChangingReturnValuesBasedOnInput()
    {
        $foo = $this->getMockBuilder('Foo')
            ->setMethods(array('bar'))
            ->getMock();

        $valueMap = array(
            array(1, 'I'),
            array(4, 'IV'),
            array(10, 'X'),
        );

        $foo->expects($this->any())
            ->method('bar')
            ->will($this->returnValueMap($valueMap));

        $expectedResults = array('I', 'IV', 'X');
        $testResults = array();
        $testResults[] = $foo->bar(1);
        $testResults[] = $foo->bar(4);
        $testResults[] = $foo->bar(10);
        $this->assertEquals($expectedResults, $testResults);
    }

    /**
     * $foo->exptects->with()で複数の引数をセットした時の結果をテストできる
     */
    public function testMulitiArgument()
    {
        $foo = $this->getMockBuilder('Foo')
            ->setMethods(array('fooSum'))
            ->getMock();

        $startRow = 1;
        $endRow = 10;

        $foo->expects($this->once())
            ->method('fooSum')
            ->with($startRow, $endRow)
            ->will($this->returnValue(55));

        $expectedResults = 55;
        $testResult = $foo->fooSum(1, 10);
        $this->assertEquals($expectedResults, $testResult);
    }

    /**
     * プライベート、プロテクテッド関数のテスト
     *
     */
    public function protectedBar()
    {
        $expectedMessage = 'PROTECTED BAR';
        $foo = new Foo();
        $reflectedFoo = new ReflectionMethod($foo, 'bar');
        $reflectedFoo->setAccessible(true);
        $reflectedFoo->invoke(new Foo(), 'production');

        $this->assertAttributeEquals(
            $expectedMessage,
            'message',
            $reflectedFoo,
            'Did not get expected message'
        );

    }




}