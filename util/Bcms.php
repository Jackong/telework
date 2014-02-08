<?php
/**
 * User: daisy
 * Date: 14-1-15
 * Time: 下午10:49
 */

namespace util;

use glob\config\Service;

require_once PROJECT . "/lib/service/bcms/Bcms.class.php";

class Bcms {
    private static $bcms;

    /**
     * @return \Bcms
     */
    public static function instance() {
        if (isset(static::$bcms)) {
            return static::$bcms;
        }
        $config = Service::get('bcms');
        static::$bcms = new \Bcms($config["accessKey"], $config["secretKey"], $config['host']);
        return static::$bcms;
    }
}