<?php
/**
 * User: daisy
 * Date: 13-12-25
 * Time: 上午8:59
 */

namespace util;


use glob\config\Service;

class Mongo {

    private static $dbs = array();

    public static function instance($name) {
        if (isset(self::$dbs[$name])) {
            return self::$dbs[$name];
        }
        $service = Service::get();
        $config = $service["mongo"][$name];
        $dbname = $config['dbname'];
        $host = $config['host'];
        $port = $config['port'];
        $user = $service["ak"];
        $pwd = $service["sk"];

        $mongoClient = new \MongoClient("mongodb://{$host}:{$port}");
        $db = $mongoClient->selectDB($dbname);
        $db->authenticate($user, $pwd);
        self::$dbs[$name] = $db;
        return $db;
    }

    /**
     * @param $name
     * @return \MongoCollection
     */
    public static function user($name) {
        return self::instance("user")->selectCollection($name);
    }

    public static function job($name) {
        return self::instance("job")->selectCollection($name);
    }
} 