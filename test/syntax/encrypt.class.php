<?php
/**
 * User: daisy
 * Date: 14-1-16
 * Time: 下午9:44
 */

namespace test\syntax;


class Encrypt extends \PHPUnit_Framework_TestCase {

    public function testUsage()
    {
        $en = \util\Encrypt::encrypt("xxx", "keyx");
        $de = \util\Encrypt::decrypt($en, "keyx");
        $this->assertEquals("xxx", $de);
    }
}
 