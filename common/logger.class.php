<?php
/**
 * User: daisy
 * Date: 14-1-16
 * Time: 下午8:38
 */

namespace common;


abstract class Logger {
    private static $hnd;

    public static function level() {
        return 16;
    }

    public static function file() {
        return "/tmp/tmp.log";
    }

    private static function hnd() {
        if (!isset(self::$hnd)) {
            self::$hnd = fopen(static::file(), "a");
        }
        return self::$hnd;
    }

    public static function output($level, $messages) {
        if ($level > static::level()) {
            return;
        }
        list(, , $caller) = debug_backtrace();
        $msgStr = "";
        foreach ($messages as $message) {
            $msgStr .= "|$message";
        }
        $class = isset($caller['class']) ? $caller['class'] : "nilClass";
        $func = isset($caller['functon']) ? $caller['function'] : "nilFunc";
        $msg = sprintf("%d %s - %s>%s%s\n", $level, NOW, $class, $func, $msgStr);
        fwrite(static::hnd(), $msg);
    }

    public static function Fatal() {
        static::output(1, func_get_args());
    }

    public static function Warning() {
        static::output(2, func_get_args());
    }

    public static function Notice() {
        static::output(4, func_get_args());
    }

    public static function Trace() {
        static::output(8, func_get_args());
    }

    public static function Debug() {
        static::output(16, func_get_args());
    }
} 