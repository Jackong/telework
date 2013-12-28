<?php
/**
 * User: daisy
 * Date: 13-12-28
 * Time: 上午10:17
 */

namespace cron;


class Log {

    private static $file;

    private static function log($level, $msg) {
        if (!isset(self::$file)) {
            self::$file = fopen("/home/bae/log/cron.log", "a");
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
    }

    public static function Warning() {
        $msg = self::format(func_get_args());
        self::log(2, $msg);
    }

    public static function Notice() {
        $msg = self::format(func_get_args());
        self::log(4, $msg);
    }

    public static function Trace() {
        $msg = self::format(func_get_args());
        self::log(8, $msg);
    }

    public static function Debug() {
        $msg = self::format(func_get_args());
        self::log(16, $msg);
    }
} 