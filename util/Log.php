<?php
/**
 * User: daisy
 * Date: 13-12-22
 * Time: 下午7:33
 */

namespace util;


use common\Logger;

require_once PROJECT . "/lib/service/log/BaeLog.class.php";

class Log {
    /**
     * @var Logger
     */
    private static $logger;

    public static function setLogger(Logger $logger) {
        static::$logger = $logger;
    }

    public static function Fatal() {
        static::$logger->output(1, func_get_args());
    }

    public static function Warning() {
        static::$logger->output(2, func_get_args());
    }

    public static function Notice() {
        static::$logger->output(4, func_get_args());
    }

    public static function Trace() {
        static::$logger->output(8, func_get_args());
    }

    public static function Debug() {
        static::$logger->output(16, func_get_args());
    }
}