<?php
/**
 * User: daisy
 * Date: 14-1-16
 * Time: 下午9:07
 */

namespace test\syntax;


class Log extends \PHPUnit_Framework_TestCase {

    public function testCaller()
    {
        \util\Log::Fatal("for test");
    }
}
 