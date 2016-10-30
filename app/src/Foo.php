<?php
/**
 * Created by PhpStorm.
 * User: Hirokazu
 * Date: 2016/10/26
 * Time: 8:53
 */
namespace UnitTest\App;

class Foo
{
    protected $message;

    public function process()
    {
        return 'hogeFoo';
    }

    protected function bar($env)
    {
        $this->message = 'PROTECTED BAR';
        if ($env == 'dev') {
            $this->message = 'CANDY BAR';
        }
    }

    protected function bar2($env)
    {
        $this->message = 'PROTECTED BAR';
        if ($env == 'dev') {
            $this->message = 'CANDY BAR';
        }
    }
}
