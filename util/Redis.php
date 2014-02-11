<?php
/**
 * User: jackong
 * Date: 2/11/14
 * Time: 11:02 AM
 */

namespace util;


use glob\config\Service;

class Redis {

    /**
     * @param $dbname
     * @return null|\Redis
     */
    public static function select($dbname) {
        $redis = new \Redis();
        $service = Service::get();
        if (!isset($service['redis'][$dbname])) {
            Log::Warning($dbname, 'not exist');
            return null;
        }
        $config = $service['redis'][$dbname];
        $ret = $redis->pconnect($config['host'], $config['port']);
        if ($ret === false) {
            Log::Warning($redis->getLastError());
            return null;
        }

        $ret = $redis->auth($service['ak'] . "-" . $service['sk'] . "-" . $dbname);
        if ($ret === false) {
            Log::Warning($redis->getLastError());
            return null;
        }

        return $redis;
    }
} 