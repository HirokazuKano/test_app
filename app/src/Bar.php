<?php
/**
 * Created by PhpStorm.
 * User: Hirokazu
 * Date: 2016/10/26
 * Time: 8:53
 */
namespace UnitTest\App;

class Bar
{
    public function getStatus()
    {
        return 'merge-ready';
    }

    public function merge()
    {
        return 'getBarMerge';
    }
}
