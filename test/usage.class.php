<?php
/**
 * User: daisy
 * Date: 14-1-10
 * Time: 下午9:27
 */

namespace test;


use glob\config\Service;
use util\Mongo;

class Usage extends \PHPUnit_Framework_TestCase {

    public function testMongo() {
        $client = new \MongoClient();
        $db = $client->selectDB("test");
        $collection = $db->selectCollection("testc");
        $this->assertEquals(0, $collection->count());

        Mongo::instance("user");
    }

    public function testloadConfig() {
        $service = Service::get();
        $this->assertTrue(is_array($service));
    }

    public function testArrayMerge() {
        $arr1 = array('a' => 2, 'b' => 'cc', 'c' => array('xx'));
        $arr2 = array('a' => 'ww', 'b' => 24, 'c' => array('oo', 'dd'), 'd' => 'haha');
        var_export(array_merge($arr1, $arr2));
        var_export(array_merge_recursive($arr1, $arr2));
        var_export($arr1 + $arr2);
    }


}
 