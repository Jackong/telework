<?php
/**
 * User: daisy
 * Date: 13-12-28
 * Time: 下午4:38
 */

namespace util;
use glob\Service;

require_once PROJECT . "/lib/service/bcs/bcs.class.php";


class Bcs {
    private static $bcs;
    public static function instance() {
        if (isset(self::$bcs)) {
            return self::$bcs;
        }
        self::$bcs = new \BaiduBCS(Service::$ak, Service::$sk, "bcs.duapp.com");
        return self::$bcs;
    }
} 