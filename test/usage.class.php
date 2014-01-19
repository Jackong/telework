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
}
 