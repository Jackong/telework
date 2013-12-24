<?php
/**
 * User: daisy
 * Date: 13-12-22
 * Time: 下午7:33
 */

namespace util;
require_once PROJECT . "/lib/service/log/BaeLog.class.php";

class Log {
    private static $file;
    private static $baeLog;

    private static function instance() {
        if (!isset(self::$baeLog)) {
            $secret = array("user"=> \ServiceConf::$aksk['ak'],"passwd"=> \ServiceConf::$aksk['sk']);
            self::$baeLog = \BaeLog::getInstance($secret);
            self::$baeLog->setLogLevel(\ServiceConf::$log_cfg["level"]);
        }
        return self::$baeLog;
    }

    private static function log($level, $msg) {
        if (!isset(self::$file)) {
            self::$file = fopen("/home/bae/log/user.log", "a");
        }
        fwrite(self::$file, "$level " . NOW . " - $msg\n");
    }

    public static function Fatal($logmsg) {
        self::log(1, $logmsg);
        self::instance()->Fatal($logmsg);
    }

    public static function Warning($logmsg) {
        self::log(2, $logmsg);
        self::instance()->Warning($logmsg);
    }

    public static function Notice($logmsg) {
        self::log(4, $logmsg);
        self::instance()->Notice($logmsg);
    }

    public static function Trace($logmsg) {
        self::log(8, $logmsg);
        self::instance()->Trace($logmsg);
    }

    public static function Debug($logmsg) {
        self::log(16, $logmsg);
        self::instance()->Debug($logmsg);
    }

}