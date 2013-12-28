<?php
/**
 * User: daisy
 * Date: 13-12-28
 * Time: 下午12:24
 */

namespace test\syntax;


class Syntax extends \PHPUnit_Framework_TestCase {

    public function testExplode() {
        $c = explode(":", "xxoo kk");
        $this->assertEquals(1, count($c));
        $this->assertEquals("xxoo kk", $c[0]);
    }
}
 