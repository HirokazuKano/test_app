<?php
/**
 * Created by PhpStorm.
 * User: Hirokazu
 * Date: 2016/10/26
 * Time: 8:53
 */
namespace UnitTest\App;
use UnitTest\App\Foo;

//ini_set('display_errors', 1);
//require '../../vendor/autoload.php';
//echo dirname(__DIR__) . '/vendor/autoload.php';

class Baz
{
    public $foo;
    public $bar;

    public function __construct($foo, $bar)
    {
        //var_dump($foo, $bar);
        $this->foo = $foo;
        $this->bar = $bar;
    }

    public function processFoo()
    {
        return $this->foo->process();
    }

    public function mergeBar()
    {
        if ($this->bar->getStatus() == 'merge-ready') {
            $this->bar->merge();
            return true;
        }

        return false;
    }
}
//$foo = new Foo();
