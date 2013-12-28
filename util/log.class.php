<?php
/**
 * User: daisy
 * Date: 13-12-22
 * Time: 下午7:33
 */

namespace util;
use glob\Service;

require_once PROJECT . "/lib/service/log/BaeLog.class.php";

class Log {
    private static $file;
    private static $baeLog;

    private static function instance() {
        if (!isset(self::$baeLog)) {
            $secret = array("user"=> Service::$aksk['ak'],"passwd"=> Service::$aksk['sk']);
            self::$baeLog = \BaeLog::getInstance($secret);
            self::$baeLog->setLogLevel(Service::$log_cfg["level"]);
        }
        return self::$baeLog;
    }

    private static function log($level, $msg) {
        if (!isset(self::$file)) {
            self::$file = fopen("/home/bae/log/user.log", "a");
        }
        fwrite(self::$file, "$level " . NOW . " - $msg\n");
    }

    private static function format($messages) {
        $trace = debug_backtrace();
        $trace = $trace[2];
        $msgStr = "";
        foreach ($messages as $message) {
            $msgStr .= "|$message";
        }

        return "${trace['class']}>${trace['function']}$msgStr";
    }

    public static function Fatal() {
        $msg = self::format(func_get_args());
        self::log(1, $msg);
        self::instance()->Fatal($msg);
    }

    public static function Warning() {
        $msg = self::format(func_get_args());
        self::log(2, $msg);
        self::instance()->Warning($msg);
    }

    public static function Notice() {
        $msg = self::format(func_get_args());
        self::log(4, $msg);
        self::instance()->Notice($msg);
    }

    public static function Trace() {
        $msg = self::format(func_get_args());
        self::log(8, $msg);
        self::instance()->Trace($msg);
    }

    public static function Debug() {
        $msg = self::format(func_get_args());
        self::log(16, $msg);
        self::instance()->Debug($msg);
    }

}