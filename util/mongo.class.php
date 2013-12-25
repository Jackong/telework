<?php
/**
 * User: daisy
 * Date: 13-12-25
 * Time: 上午8:59
 */

namespace util;


class Mongo {

    private static $db;

    public static function instance() {
        if (isset(self::$db)) {
            return self::$db;
        }
        $dbname = \ServiceConf::$mongo_cfg['dbname'];
        $host = \ServiceConf::$mongo_cfg['host'];
        $port = \ServiceConf::$mongo_cfg['port'];
        $user = \ServiceConf::$aksk['ak'];
        $pwd = \ServiceConf::$aksk['sk'];

        $mongoClient = new \MongoClient("mongodb://{$host}:{$port}");
        self::$db = $mongoClient->selectDB($dbname);
        self::$db->authenticate($user, $pwd);
        return self::$db;
    }

    public static function collection($name) {
        return self::instance()->selectCollection($name);
    }
} 